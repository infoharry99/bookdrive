<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Models\payments\paymentdetails;
use App\Models\payments\paymentstudents;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index(){
        $statuses = (new CommonController)->status();
        $payments = paymentdetails::select('paymentdetails.id as transaction_id','paymentdetails.transaction_id as transaction_no','paymentdetails.payment_date as transaction_date','paymentdetails.payment_mode as payment_mode','paymentdetails.amount as transaction_amount','statuses.id as transaction_status_id','statuses.name as transaction_status','paymentdetails.remarks as remarks','studentregistrations.id as student_id','studentregistrations.name as student_name','classes.name as class_name','subjects.name as subject_name','tutorregistrations.id as tutor_id','tutorregistrations.name as tutor_name')
        ->join('paymentstudents','paymentstudents.transaction_id','paymentdetails.transaction_id')
        ->join('studentregistrations','studentregistrations.id','paymentstudents.student_id')
        ->join('classes','classes.id','studentregistrations.class_id')
        ->join('subjects','subjects.id','paymentstudents.subject_id')
        ->join('tutorregistrations','tutorregistrations.id','paymentstudents.tutor_id')
        ->join('statuses','statuses.id','paymentdetails.status')
        ->paginate(10);
        return view('admin.payments',compact('payments','statuses'));
    }

    public function update(Request $request){
        $request->validate([
            'transactionid'=>'required',
            'paymentstatus'=>'required',
            'transactionremarks'=>'required'
        ]);
        $data = paymentdetails::find($request->transactionid);
        $data->status = $request->paymentstatus;
        $data->remarks = $request->transactionremarks;
        $res = $data->save();
        if($res){
            return back()->with('success','Payment details updated successfully');
        }
        else{
            return back()->with('fail','Something went wrong. Please try again later');
        }
    }

    public function tutorpaymentslist(){

        return view('admin.tutorpaymentlist');
    }

    public function tutorpayments(){

        return view('admin.tutorpayment');
    }

    public function studentpayments(){

        $payments = paymentstudents::select('paymentstudents.*','classes.name as class','subjects.name as subject','tutorregistrations.name as tutor','paymentdetails.id as paymentdetails_id','paymentdetails.amount as amount')
                    ->join('classes','classes.id','paymentstudents.class_id')
                    ->join('subjects', 'subjects.id','paymentstudents.subject_id')
                    ->join('tutorregistrations','tutorregistrations.id','paymentstudents.tutor_id')
                    ->join('paymentdetails','paymentdetails.transaction_id','paymentstudents.transaction_id')
                    ->where('paymentstudents.student_id',session('userid')->id)
                    ->get();
        
        return view('student.fees',compact('payments'));
    }
}
