<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\studentprofile;
use App\Models\studentregistration;
use Illuminate\Http\Request;
use App\Models\tutorprofile;
use App\Models\democlasses;
use App\Models\subjects;
use App\Models\zoom_classes;
use App\Models\Notification;
use App\Models\OnlineTests;
use App\Models\Form;
use Illuminate\Support\Carbon;
use App\Models\payments\paymentdetails;
use DB;
class LeadsController extends Controller
{
    // public function index(){
    //     $forms = Form::all();
       


    //     return view('admin.leads', compact('forms'));
    // }
    
    public function index()
{
    $forms = Form::select('forms.*', 'price_details.*', 'finalforms.*', 'bookings.*')
        ->join('price_details', 'forms.id', '=', 'price_details.form_id')
        ->join('finalforms', 'finalforms.postcode', '=', 'price_details.id')
        ->join('bookings', 'bookings.finalformid', '=', 'finalforms.id')
        ->get();
// echo "<pre>";
// print_r($forms);exit;
    return view('admin.leads', compact('forms'));
}


    public function notificationslist(){
        $notifications = Notification::select('*')
        // ->where('show_to_admin',1)
        ->orderBy('created_at','desc')
        // ->where('show_to_student_id', session('userid')->id)
        ->paginate(20);
        return view('admin.notificationslist', compact('notifications'));
    }
    public function notificationdelete($id){

        $data = Notification::find($id);

        $res = $data->delete();

        if($res){
            return back()->with('success','Notification deleted successfully.');
        }
        else{
            return back()->with('error','Something went wrong.');
        }
    }
}
