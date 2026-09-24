<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\SlotBooking;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.form');
    }

    public function pay(Request $request)
    {
        $merchantTransactionId = 'TXN' . time(); 
        $amount = "1.00";
        $currency = "GBP";

        $memberId = env('TRANSACTWORLD_MEMBER_ID');
        $totype = env('TRANSACTWORLD_TOTYPE');
        $merchantRedirectUrl = env('TRANSACTWORLD_REDIRECT_URL');
        $secureKey = env('TRANSACTWORLD_CHECKSUM_KEY');

        $checksumString = "{$memberId}|{$totype}|{$amount}|{$merchantTransactionId}|{$merchantRedirectUrl}|{$secureKey}";
        $checksum = md5($checksumString);
        $data = [
            'memberId' => '16265',
            'language' => env('TRANSACTWORLD_LANGUAGE'),
            'checksum' => $checksum,
            'totype' => $totype,
            'merchantTransactionId' => $merchantTransactionId,
            'amount' => $amount,
            'TMPL_AMOUNT' => $amount,
            'orderDescription' => 'Test Transaction',
            'merchantRedirectUrl' => $merchantRedirectUrl,
            'notificationUrl' => env('TRANSACTWORLD_NOTIFICATION_URL'),
            'country' => 'UK',
            'city' => 'Aston',
            'state' => 'NA',
            'postcode' => 'CR2 6XH',
            'street' => '19 Scrimshire Lane',
            'telnocc' => '+44',
            'phone' => '07730432996',
            'email' => 'john.d@domain.com',
            'ip' => $request->ip(),
            'currency' => $currency,
            'TMPL_CURRENCY' => $currency,
            'reservedField1' => ''
        ];
        return view('payment.redirect', compact('data'));
    }


    // After payment redirect
    public function success(Request $request)
    {
        // Log entire response for debugging
        \Log::info('TransactWorld Response:', $request->all());

        // Get key parameters from TransactWorld callback
        $transactionId = $request->input('merchantTransactionId');
        $status = $request->input('status'); // Y = success, N = failed
        $checksum = $request->input('checksum');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $payment = DB::table('paymentdetails')->where('transaction_id', $transactionId)->first();

        if($status == 'N')  {
            \Log::error('Payment not found for Transaction ID: ' . $transactionId);
            return view('payment.failed', ['reason' => 'Payment not found']);
        }

        if(empty($payment)) {
            \Log::error('Payment not found for Transaction ID: ' . $transactionId);
            return view('payment.failed', ['reason' => 'Payment not found']);
        }

        SlotBooking::where('transaction_id', $transactionId)->update(['status' => 1]);

        DB::table('paymentdetails')->where('transaction_id', $transactionId)->update(['status' => 1]);
        DB::table('paymentstudents')->where('transaction_id', $transactionId)->update(['status' => 1]);

        // ✅ Step 5: Fetch full payment details for emails
       $paymentStudent = DB::table('paymentstudents')
                    ->select(
                        'paymentstudents.*',
                        'studentregistrations.*',
                        'bookings.*',
                        'subjects.name as subject_name'
                    )
                    ->join('bookings', 'bookings.s_uid', '=', 'paymentstudents.student_id')
                    ->join('studentregistrations', 'studentregistrations.id', '=', 'paymentstudents.student_id')
                    ->join('subjects', 'subjects.id', '=', 'paymentstudents.subject_id')
                    ->where('paymentstudents.transaction_id', $transactionId)
                    ->first();


        $paymentDetail = DB::table('paymentdetails')
            ->where('transaction_id', $transactionId)
            ->first();

       

        // ✅ Step 6: Send email to student
        $studentMailData = [
            'name' => $paymentStudent->name ?? null,
            'phone' => $paymentStudent->mobile ?? null,
            'email' => $paymentStudent->email ?? null, 
            'classpuchased' => $paymentStudent->classes_purchased ?? 1,
            'postcode' => $paymentStudent->subject_name ?? "Test",
            'transaction_id' => $paymentStudent->transaction_id ?? null,
            'total_amount' => $paymentDetail->amount ??1,
            'mailtype' => 8,
        ];

        if(isset($paymentStudent->email) && !empty($paymentStudent->email) ){
            Mail::to($paymentStudent->email)->send(new SendMail($studentMailData));
        }
        
        $adminMailData = [
            'name' => $paymentStudent->name ?? null,
            'phone' => $paymentStudent->mobile ?? null,
            'email' => $paymentStudent->email ?? null,
            'classpuchased' => $paymentStudent->classes_purchased ?? 1,
            'postcode' => $paymentStudent->subject_name ?? "Test",
            'transaction_id' => $paymentStudent->transaction_id ?? null,
            'licence' => $paymentStudent->licence ?? null ,
            'pass_theory' => $paymentStudent->pass_theory ?? null,
            'prefered_test_center' => $paymentStudent->prefered_test_center ?? null,
            'total_amount' => $paymentDetail->amount,
            'mailtype' => 7,
        ];
    
        Mail::to('7daysinstructors@gmail.com')->send(new SendMail($adminMailData));
        return view('payment.success', compact('transactionId'));
    }
    

    public function successpage(Request $request)
    {
        $all = $request->all();
        return view('payment.success', ['response' => $request->all()]);
    }

    public function notify(Request $request)
    {
        \Log::info('TransactWorld Notification:', $request->all());
        return response('OK', 200);
    }
}
