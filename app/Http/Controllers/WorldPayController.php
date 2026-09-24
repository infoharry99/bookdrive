<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\DrivingTestRequest;
use App\Models\SlotBooking;

use App\Mail\SendMail;

class WorldPayController extends Controller
{
    public function showPaymentPage()
    {   

        return view('payment.form');
        // $order_id ="Order" . time();
        // return view('worldpay.hpp', compact('order_id'));
    }
    
    public function paymentstatus(Request $request) {
         $order_id = $request->query('order_id');
         return view('payments.failure', compact('order_id'));
    }
     public function cancel(Request $request) {
          $order_id = $request->query('order_id');
         return view('payments.cance;', compact('order_id'));
    }
     public function pending(Request $request) {
          $order_id = $request->query('order_id');
         return view('payments.pending', compact('order_id'));
    }
     public function failure(Request $request) {
         $order_id = $request->query('order_id');
         return view('payments.failure', compact('order_id'));
    }
    
    public function success(Request $request) {
        $order_id = $request->query('order_id');

        if ($order_id) {
            $slotbooking = SlotBooking::where('transaction_id', $order_id)->get();
            if ($slotbooking->isNotEmpty()) {
                 SlotBooking::where('transaction_id', $order_id)->update(['status' => 1]);
            }
            $update = DB::table('paymentdetails')
                        ->where('transaction_id', $order_id)
                        ->update(['status' => 1]);
            $updatepyment = DB::table('paymentstudents')
                        ->where('transaction_id', $order_id)
                        ->update(['status' => 1]);
                        
        }
     $updatepyment = DB::table('paymentstudents')
                    ->select(
                        'paymentstudents.*',
                        'studentregistrations.*',
                        'bookings.*',
                        'subjects.name as subject_name'
                    )
                    ->join('bookings', 'bookings.s_uid', '=', 'paymentstudents.student_id')
                    ->join('studentregistrations', 'studentregistrations.id', '=', 'paymentstudents.student_id')
                    ->join('subjects', 'subjects.id', '=', 'paymentstudents.subject_id')
                    ->where('paymentstudents.transaction_id', $order_id)
                    ->first();
                
        $amont = DB::table('paymentdetails')
                ->where('transaction_id', $order_id)
                ->first();
        $detail = [
            'name' => $updatepyment->name,
            'phone' => $updatepyment->mobile,
            'email' => $updatepyment->email,
            'classpuchased' => $updatepyment->classes_purchased,
            'postcode' => $updatepyment->subject_name,
            'transaction_id' => $updatepyment->transaction_id,
            'total_amount' => $amont->amount,
            'mailtype' => 8,
        ];
        Mail::to($updatepyment->email)->send(new SendMail($detail));
        
        $details = [
            'name' => $updatepyment->name,
            'phone' => $updatepyment->mobile,
            'email' => $updatepyment->email,
            'classpuchased' => $updatepyment->classes_purchased,
            'postcode' => $updatepyment->subject_name,
            'transaction_id' => $updatepyment->transaction_id,
            'licence' => $updatepyment->licence,
            'pass_theory' => $updatepyment->pass_theory ?? null,
            "prefered_test_center"=>$updatepyment->prefered_test_center ?? null,
            'total_amount' => $amont->amount,
            'mailtype' => 7,
        ];
        
        Mail::to('7daysinstructors@gmail.com')->send(new SendMail($details));

         return view('payments.success', compact('order_id'));

        \Log::info($request->all());
    }
    
    public function callback(Request $request) {
        // \Log::info(json_decode($request->all()));
        \Log::info($request->all());
    }

    public function initiatePayment(Request $request)
    {
        $username = 'RYwy3p5Gc1OSmA8c'; 
        $password = 'O8jW0H3HcAs8w1OvwIAFKX0JWaZujcu5rmUddRK0ZnPHUqbLFzRcdhOJ4nAyGU0k'; 
        $amt = $request->amount;
        $purpose = $request->purpose?? null;
  
        $curl = curl_init();
        
        $payload = array(
          "transactionReference" => "ordersd265-13/08/1876",
          "merchant" => array(
            "entity" => "PO4057534139"
          ),
          "instruction" => array(
            "method" => "card",
            "paymentInstrument" => array(
              "type" => "plain",
              "cardHolderName" => "Sherlock Holmes",
              "cardNumber" => "4000000000001091",
              "expiryDate" => array(
                "month" => 5,
                "year" => 2035
              )
            ),
            "tokenCreation" => array(
              "type" => "worldpay"
            ),
            "customerAgreement" => array(
              "type" => "cardOnFile",
              "storedCardUsage" => "first"
            ),
            "narrative" => array(
              "line1" => "trading name"
            ),
            "value" => array(
              "currency" => "GBP",
              "amount" => 0
            )
          )
        );
        
        curl_setopt_array($curl, [
          CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "WP-Api-Version: 2024-06-01",
            "Authorization: Basic " . base64_encode("RYwy3p5Gc1OSmA8c:O8jW0H3HcAs8w1OvwIAFKX0JWaZujcu5rmUddRK0ZnPHUqbLFzRcdhOJ4nAyGU0k")
          ],
          CURLOPT_POSTFIELDS => json_encode($payload),
          CURLOPT_URL => "https://try.access.worldpay.com/api/payments",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        dd($response);
        
        curl_close($curl);
        
        if ($error) {
          echo "cURL Error #:" . $error;
        } else {
          echo $response;
        }

        $curl = curl_init();
        
        $payload = array(
          "transactionReference" => "Memory265-13/08/1876",
          "merchant" => array(
            "entity" => "PO4057534139"
          ),
          "instruction" => array(
            "method" => "card",
            "paymentInstrument" => array(
              "type" => "plain",
              "cardHolderName" => "Sherlock Holmes",
              "cardNumber" => "4000000000001091",
              "expiryDate" => array(
                "month" => 5,
                "year" => 2035
              ),
              "billingAddress" => array(
                "address1" => "221B Baker Street",
                "address2" => "Marylebone",
                "address3" => "Westminster",
                "postalCode" => "SW1 1AA",
                "city" => "London",
                "state" => "Greater London",
                "countryCode" => "GB"
              ),
              "cvc" => "123"
            ),
            "narrative" => array(
              "line1" => "trading name"
            ),
            "value" => array(
              "currency" => "GBP",
              "amount" => 42
            )
          )
        );
        
        curl_setopt_array($curl, [
          CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "WP-Api-Version: 2024-06-01",
            "Authorization: Basic " . base64_encode("RYwy3p5Gc1OSmA8c:O8jW0H3HcAs8w1OvwIAFKX0JWaZujcu5rmUddRK0ZnPHUqbLFzRcdhOJ4nAyGU0k")
          ],
          CURLOPT_POSTFIELDS => json_encode($payload),
          CURLOPT_URL => "https://try.access.worldpay.com/api/payments",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        dd( $response);
        if ($error) {
          echo "cURL Error #:" . $error;
        } else {
          echo $response;
        }
        dd($response);
        if ($error) {
          echo "cURL Error #:" . $error;
        } else {
          echo $response;
        }

        $curl = curl_init();
        
        $payload = array(
          "transactionReference" => "Memory265-13/08/1876",
          "merchant" => array(
            "entity" => "PO4057534139"
          ),
          "instruction" => array(
            "requestAutoSettlement" => array(
              "enabled" => false
            ),
            "narrative" => array(
              "line1" => "MindPalace"
            ),
            "value" => array(
              "currency" => "GBP",
              "amount" => 250
            ),
            "paymentInstrument" => array(
              "type" => "card/plain",
              "cardNumber" => "4000000000002701",
              "expiryDate" => array(
                "month" =>8,
                "year" => 2035
              )
            ),
            "customerAgreement" => array(
              "type" => "subscription",
              "schemeReference" => "MCCOLXT1C01sds"
            )
          )
        );
        
        curl_setopt_array($curl, [
          CURLOPT_HTTPHEADER => [
            "Accept: application/vnd.worldpay.payments-v7+json",
            "Content-Type: application/vnd.worldpay.payments-v7+json",
            "Authorization: Basic " . base64_encode("RYwy3p5Gc1OSmA8c:O8jW0H3HcAs8w1OvwIAFKX0JWaZujcu5rmUddRK0ZnPHUqbLFzRcdhOJ4nAyGU0k")
          ],
          CURLOPT_POSTFIELDS => json_encode($payload),
          CURLOPT_URL => "https://try.access.worldpay.com/api/payments",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        dd($response);
        if ($error) {
          echo "cURL Error #:" . $error;
        } else {
          echo $response;
        }
        $response = Http::withBasicAuth($username, $password)
                    ->withHeaders([
                        'Content-Type' => 'application/vnd.worldpay.payment_pages-v1.hal+json',
                        'Accept' => 'application/vnd.worldpay.payment_pages-v1.hal+json',
                    ])
                    ->post('https://try.access.worldpay.com/payment_pages', [
                        'transactionReference' => $purpose,
                        'merchant' => [
                            'entity' => 'PO4057534139',
                        ],
                        'narrative' => [
                            'line1' => 'Deepesh-001',
                        ],
                        'value' => [
                            'currency' => 'GBP',
                            'amount' => $amt *100, 
                        ],
                      "resultURLs" => array(
                        "successURL" => "https://bookdriver.sofinish.co.uk/worldpay/success",
                        "pendingURL" => "https://bookdriver.sofinish.co.uk/worldpay/pending",
                        "failureURL" => "https://bookdriver.sofinish.co.uk/worldpay/failure",
                        "errorURL"  =>   "https://bookdriver.sofinish.co.uk/worldpay/error",
                        "cancelURL" =>  "https://bookdriver.sofinish.co.uk/worldpay/cancel",
                        "expiryURL" =>  "https://bookdriver.sofinish.co.uk/worldpay/expiry"
                      ),
                    ]);
        
        if($response->successful()) {
            $responseData = $response->json();
            $paymentUrl = $responseData['url'];
            return redirect()->away($paymentUrl);
        }

        return response()->json(['error' => 'Payment initiation failed'], 500);
    }
}
