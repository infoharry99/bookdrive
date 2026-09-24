<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form; // Import the Form model
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\studentregistration;
use Illuminate\Support\Carbon;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use App\Models\Notification;
use App\Models\payments\paymentdetails;
use App\Models\payments\paymentstudents;
class FormController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('front-cms/advanceSearch');
    }


    public function AshowForm()
    {
        return view('front-cms/finalSearch');
    }

    // Store form data
    public function store(Request $request)
    {
        // Validate the form data
       // dd($request);
        // $validated = $request->validate([
        //     // 'postcode' => 'required|string|max:10',
        //     // 'mobile_number' => 'required|numeric',
        //     // 'opt_in' => 'boolean',
        //     'lessonstype' => 'required',
        //     'transmission' => 'required',
        //     'fasttrack' => 'required',
        //     'spreadoutLesson' => 'required',
        //     'fasttrackdriving' => 'required',
        //     'bookedDrivingtest' => 'required',
        //     'drivingtestDate' => 'nullable|date',
        //     'flexible' => 'boolean',
        //     'weekday_morning' => 'boolean',
        //     'weekday_afternoon' => 'boolean',
        //     'weekday_evening' => 'boolean',
        //     'weekend' => 'boolean',
        //     'previous_experience' => 'nullable|string',
        // ]);

        $request->validate([
            // 'lessonstype' => 'required|in:weekly,intensive',
            // 'transmission' => 'required|in:manual,auto',
            // 'fasttrack' => 'required|in:yes,no',
            // 'fasttrackdriving' => 'required|in:yes,no',
            // //'bookedDrivingtest' => 'required|in:yes,no',
            // //'spreadoutLesson' => 'nullable|in:yes,no',
            // 'driving-experience' => 'nullable|in:1-10',
            // 'lesson-time' => 'nullable|in:weekly-morning,weekly-afternoon,weekly-evening,weekend',
        ]);
    
        // Store the form data into the database using $request->input() to retrieve values
        
      $form =   Form::create([
            'postcode' => $request->input('postcode'),
            'mobile_number' => $request->input('mobile_number'),
            'opt_in' => $request->input('opt_in'),
            'lessonstype' => $request->input('lessonstype'),
            'transmission' => $request->input('transmission'),
            'fasttrack' => $request->input('fasttrack'),
            'fasttrackdriving' => $request->input('fasttrackdriving'),
            'bookedDrivingtest' => $request->input('bookedDrivingtest'),
            'spreadoutLesson' => $request->input('spreadoutLesson', null),
            'drivingExperience' => $request->input('driving-experience', null),
            'drivingtestDate' => $request->input('drivingtestDate'),
            'lessonTime' => $request->input('lesson-time', null),
        ]);
        
       // $formId = $form->id;
      //  dd($formId);
        $postcode = $request->input('postcode'); 
        $first_part = explode(' ', $postcode)[0];
        $subjectExists = DB::table('subjects')->where('name', $first_part)->exists();
         if ($subjectExists) {
   
    
            //   $tutors = DB::table('tutorsubjectmappings as s')
            //     ->join('tutorprofiles as tp', 'tp.tutor_id', '=', 's.tutor_id')
            //     ->leftJoin('subjects as sb', 'sb.id', '=', 's.subject_id')
            //     ->select('s.tutor_id', 's.subject_id', 'tp.tutor_id', 'tp.rateperhour', 'tp.rateperhour2', 'tp.rateperhour3', 'sb.name as subject_name','tp.name')
            //     ->where('sb.name', '=', $request->input('postcode'))
            //     ->get();
            $tutors = DB::table('tutorsubjectmappings as s')
                ->join('tutorprofiles as tp', 'tp.tutor_id', '=', 's.tutor_id')
                ->leftJoin('subjects as sb', 'sb.id', '=', 's.subject_id')
                ->select('s.tutor_id', 's.subject_id', 'tp.tutor_id', 'tp.rateperhour', 'tp.rateperhour2', 'tp.rateperhour3', 'sb.name as subject_name', 'tp.name as name')
                ->where('sb.name', '=',$first_part)
            
                ->where(function($query) {
                    $query->where('tp.rateperhour', '>', 0)
                          ->orWhere('tp.rateperhour2', '>', 0)
                          ->orWhere('tp.rateperhour3', '>', 0);
                })
                ->get();
             //dd($tutors);
               return view('front-cms/advanceSearch', compact('tutors','form'));
             
             
         }
         else {
      
        return redirect()->back()->with('error', 'No matching subjects found for this postcode.');
    }
        // Redirect with success message
       // return redirect()->back()->with('success', 'Form submitted successfully!');
    }
    
    
    public function storeprice(Request $request)
{
    // echo "<pre>";
    // print_r($request->input('hourss'));exit;
  //   dd($request->all());
    //echo 'ji';exit;
    //print_r($request->input('tutorId'));exit;
    // Validate the request
  $validator = Validator::make($request->all(), [
        'formId' => 'required|numeric|exists:forms,id', // Form ID should exist in the forstoreformsms table
        'tutorId' => 'required|numeric|exists:tutorprofiles,tutor_id', // Tutor ID should exist in the tutorprofiles table
        'totalPrice' => 'required|numeric|min:0', // Total price should be a valid numeric value and >= 0
    ]);

    // Check if the validation failed
    if ($validator->fails()) {
        // Return error response with the first validation error
        return response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first()
        ], 400);
    }
    
     $existingPriceDetail = DB::table('price_details')
                             ->where('form_id', $request->input('formId'))
                             ->first();
 if ($existingPriceDetail) {
        DB::table('price_details')
          ->where('form_id', $request->input('formId'))
          ->delete();
    }
// // // // 
//echo 'ji';exit;
    // Insert data into custom price details table
   try {
//   $priceDetail =  DB::table('price_details')->insert([
//         'form_id' => $request->input('formId'),
//         'tutor_id' => $request->input('tutorId'),
//         'total_price' => $request->input('totalPrice'),
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);
  $priceDetailId = DB::table('price_details')->insertGetId([
            'form_id' => $request->input('formId'),
            'tutor_id' => $request->input('tutorId'),
            'total_price' => $request->input('totalPrice'),
            'selected_hrs'=>$request->input('hourss'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
} catch (\Exception $e) {
    // Log the error message
    \Log::error('Error inserting into price_details: ' . $e->getMessage());
    return redirect()->back()->with('error', 'An error occurred while saving the booking.');
}
//dd('hi');

return view('front-cms/finalSearch', compact('priceDetailId'));
    // Redirect or return response
   // return redirect()->route('front-cms.finalSearch')->with('success', 'Booking has been made successfully.');
}


    public function storeforms(Request $request)
    {
       // dd('ji');
                // Validate the request data
        //         $validator = Validator::make($request->all(), [
        //         'postcode' => 'required|string',
        //         'mobile_number' => 'required|string',
        //         'opt_in' => 'required|boolean',
        //         'passed_theory' => 'nullable|in:yes,no',
        //         'theory_date' => 'nullable|date',
        //         'book_quicker_theory' => 'nullable|in:yes,no',
        //         'zoom_training' => 'nullable|in:yes,no',
        //         'revision_app' => 'nullable|in:yes,no',
        //     ]);
        //dd($request);
        //   $validatedData = $validator->validated();
         
            // Insert the validated data directly into the database
        //   $final = DB::table('finalforms')->insert([
        //         'postcode' => $request['opt_in'],
        //         'passed_theory' => $request['passed_theory'] ?? null,
        //         'theory_date' => $request['theory_date'] ?? null,
        //         'book_quicker_theory' => $request['book_quicker_theory'] ?? null,
        //         'zoom_training' => $request['zoom_training'] ?? null,
        //         'revision_app' => $request['revision_app'] ?? null,
        //         'created_at' => now(), // Automatically set the created_at field
        //         'updated_at' => now(), // Automatically set the updated_at field
        //     ]);
        $finalId = DB::table('finalforms')->insertGetId([
            'postcode' => $request['opt_in'],
            'passed_theory' => $request['passed_theory'] ?? null,
            'theory_date' => $request['theory_date'] ?? null,
            'book_quicker_theory' => $request['book_quicker_theory'] ?? null,
            'zoom_training' => $request['zoom_training'] ?? null,
            'revision_app' => $request['revision_app'] ?? null,
            'created_at' => now(), // Automatically set the created_at field
            'updated_at' => now(), // Automatically set the updated_at field
        ]);
            $optid =$request['opt_in'];
            //dd($final);
        // Redirect with a success message
    return view('front-cms.bookingsummary', compact('finalId','optid'));    
    
//return view('front-cms/bookingsummary');
    }

public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $emailExists = DB::table('studentregistrations')->where('email', $request->email)->exists();

        return response()->json([
            'exists' => $emailExists,
        ]);
    }


    public function summarystore(Request $request)
    {
        // dd($request->all());
    
        // Validate incoming request
         // try {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'theory_test_date' => 'required',
            'practical_test_date' => 'required',
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date',
            'contact_no' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'address_line3' => 'nullable|string|max:255',
            'driving_experience' => 'required|string|max:255',
            'how_heard_about_us' => 'required|string|max:255',
            'extended_test' => 'required|string|max:255',
        ]);

        try {
                // Insert into bookings table
            DB::table('bookings')->insert([
                'finalformid' => $request['finalform_id'],
                'start_date' => $validated['start_date'],
                'theory_test_date' => $validated['theory_test_date'],
                'practical_test_date' => $validated['practical_test_date'],
                'first_name' => $validated['first_name'],
                'surname' => $validated['surname'],
                'dob' => $validated['dob'],
                'contact_no' => $validated['contact_no'],
                'email' => $validated['email'],
                'address_line1' => $validated['address_line1'],
                'address_line2' => $validated['address_line2'],
                'address_line3' => $validated['address_line3'],
                'driving_experience' => $validated['driving_experience'],
                'how_heard_about_us' => $validated['how_heard_about_us'],
                'extended_test' => $validated['extended_test'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $finalId = $request->input('finalform_id');
            $emailcount = \DB::table('studentregistrations')->where('email', '=', $request->email)->count(); 

            if ($emailcount > 0) {
                $id = session('userid')->id ;
                $userId = DB::table('studentregistrations')->where('email', $request->email)->value('id');
                DB::table('bookings')->where('finalformid', $finalId)->update(['s_uid' => $userId]); 
                return view('front-cms.bookingsuccess', compact('finalId'))->with('success', 'Registration successful. Please check your mobile for OTP.');
                //return back()->with('fail', 'Email already registered. Please use a different email address.');
            }else{
                // Create student registration
                $userId = DB::table('studentregistrations')->insertGetId([
                    'mobile' => $request->contact_no,
                    'role_id' => 3,
                    'class_id' => 0,
                    'name' => $validated['first_name'] . ' ' . $validated['surname'],
                    'email' => $request->email,
                    'is_active' => 1,
                    'password' => Hash::make($request->password),
                    'parent_password' => Hash::make($request->contact_no),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // $form = DB::table('finalforms')->where('postcode', $finalId)->first();
                DB::table('bookings')->where('finalformid', $finalId)->update(['s_uid' => $userId]);
                DB::table('studentprofiles')->insert([
                    'name' => $validated['first_name'] . ' ' . $validated['surname'],
                    'mobile' => $request->contact_no,
                    'email' => $request->email,
                    'student_id' => $userId,
                    'grade' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                

                // Send welcome mail
                $pass  = $request->password;
                $email =  $request->email;

                $details = [
                    'name' => $validated['first_name'] . ' ' . $validated['surname'],
                    'mobile' => $request->contact_no,
                    'password' => $request->password,
                    'mailtype' => 1,
                ];
                Mail::to($request->email)->send(new SendMail($details));
                
                // Send OTP
                $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $formattedDate = now()->format('Y-m-d');
                $url = "https://bhashsms.com/api/sendmsg.php?user=BhashWAPAI&pass=123456&sender=BUZWAP&phone={$request->contact_no}&text=delivery&priority=wa&stype=normal&params={$otp},{$formattedDate}";
                
                $client = new Client();
                try {
                    $client->get($url);
                } catch (\Exception $e) {
                    return response()->json(['message' => 'OTP sending failed', 'error' => $e->getMessage()], 500);
                }
                
                // Save OTP in the database
                DB::table('studentregistrations')
                    ->where('id', $userId)
                    ->update(['mobile_otp' => $otp, 'updated_at' => now()]);
                    $selectedSlotIds = 1;
                    $contactadmin = $request->contactadmin;
                    $optid = $request->optid;

                    $price = DB::table('price_details')->where('id', $optid)->first();
                    $order_id = '1234-5678-qqyz-aspa-zqkp1o2';
            
                    // $classId = subjects::select('*')->where('id', $request->subjectenrollid)->first();
                    // $tutorname = tutorprofile::select('*')->where('tutor_id', $request->tutorenrollid)->first();
            
                    $paymentdetails = new paymentdetails();
                    $paymentdetails->transaction_id = $order_id;
                    $paymentdetails->payment_mode = 'Credit Card';
                    $paymentdetails->amount = $price->total_price;
                    $paymentdetails->status = 1;
                    $test = $paymentdetails->save();
            
                    // // Step 2: Save the studentpayment record
                    $studentpayment = new paymentstudents();
                    $studentpayment->transaction_id = $order_id;
                    $studentpayment->student_id = $userId;
                    $studentpayment->class_id = 1;
                    $studentpayment->subject_id = 2;
                    $studentpayment->tutor_id = $price->tutor_id;
                    $studentpayment->classes_purchased = 1;
                    $studentpayment->rate_per_hr = 40;
                    $spdres = $studentpayment->save();
            
                    // // Send welcome mail
                    // $details = [
                    //     'name' => session('userid')->name,
                    //     'total_classes' => $request->requiredclassenroll,
                    //     'tutor_name' => $tutorname->name,
                    //     'mailtype' => 4,
                    // ];
            
                    // Mail::to(session('userid')->email)->send(new SendMail($details));
                    
                    // $selectedSlotIdsArray = explode(',', $selectedSlotIds);
                    // foreach ($selectedSlotIdsArray as $slotId) {
            
                    //     $slotbooking = SlotBooking::find($slotId);
                    //     if ($slotbooking) {
                    //         $slotbooking->student_id = session('userid')->id;
                    //         $slotbooking->booked_at = Carbon::now();
                    //         $slotbooking->transaction_id = $order_id;
                    //         $slotbooking->subject_id = 2;
                    //         $slotbooking->status = 1;
                    //         $slotbooking->contact_admin = $request->contactadmin == 'on' ? 1 : 0;
                    //         $slotbooking->class_schedule_id = $studentpayment->id;
                    //         // Save the changes
                    //         $slotbooking->save();
                    //     }
                    // }
                    // if ($contactadmin == 'on') {
            
                    //     //////////////// Here I need to pass notification into db
                    //     $notificationdata = new Notification();
                    //     $notificationdata->alert_type = 6;
                    //     $notificationdata->notification = session('userid')->name . ' Need your help in slot booking';
                    //     $notificationdata->initiator_id = session('userid')->id;
                    //     $notificationdata->initiator_role = session('userid')->role_id;
                    //     $notificationdata->event_id = $request->tutorenrollid;
                    //     // Sending to admin
                    //     // if($request->receiver_role_id == 1){
                    //     //     $notificationdata->show_to_admin = 1;
                    //     //     $notificationdata->show_to_admin_id = $request->receiver_id;
                    //     $notificationdata->show_to_all_admin = 1;
                    //     // }
                    //     // Sending to tutor
                    //     // if($request->receiver_role_id == 2){
                    //     // $notificationdata->show_to_tutor = 1;
                    //     // $notificationdata->show_to_tutor_id = $tutor_id->tutor_id;
                    //     // $notificationdata->show_to_all_tutor = 0;
                    //     // }
                    //     // Sending to student
                    //     // if($request->receiver_role_id == 3){
                    //     //     $notificationdata->show_to_student = 1;
                    //     //     $notificationdata->show_to_student_id = $request->receiver_id;
                    //     //     // $notificationdata->show_to_all_student = 0;
                    //     // }
                    //     // // Sending to parent
                    //     // if($request->receiver_role_id == 3){
                    //     //     $notificationdata->show_to_parent = 1;
                    //     //     $notificationdata->show_to_parent_id = $request->receiver_id;
                    //     //     // $notificationdata->show_to_all_parent = 0;
                    //     // }
                    //     $notificationdata->read_status = 0;
            
                    //     $notified = $notificationdata->save();
                    //     broadcast(new RealTimeMessage('$notification'));
            
                    //     $msg = 'Enrollment completed. Please have patience, admin you contact you soon.';
                    // } else {
                    //     $msg = 'Enrollment Completed & Slots confirmed. Kindly use your registered Email Id to join class.';
                    // }
            
                    // if ($spdres) {
            
                    //     //////////////// Here I need to pass notification into db
                    //     $notificationdata = new Notification();
                    //     $notificationdata->alert_type = 7;
                    //     $notificationdata->notification = session('userid')->name . ' Enrolled for classes';
                    //     $notificationdata->initiator_id = session('userid')->id;
                    //     $notificationdata->initiator_role = session('userid')->role_id;
                    //     $notificationdata->event_id = $request->tutorenrollid;
                    //     // Sending to admin
                    //     // if($request->receiver_role_id == 1){
                    //     //     $notificationdata->show_to_admin = 1;
                    //     //     $notificationdata->show_to_admin_id = $request->receiver_id;
                    //     //     // $notificationdata->show_to_all_admin = 1;
                    //     // }
                    //     // Sending to tutor
                    //     // if($request->receiver_role_id == 2){
                    //     $notificationdata->show_to_tutor = 1;
                    //     $notificationdata->show_to_tutor_id = $request->tutorenrollid;
                    //     // $notificationdata->show_to_all_tutor = 0;
                    //     // }
                    //     // Sending to student
                    //     // if($request->receiver_role_id == 3){
                    //     //     $notificationdata->show_to_student = 1;
                    //     //     $notificationdata->show_to_student_id = $request->receiver_id;
                    //     //     // $notificationdata->show_to_all_student = 0;
                    //     // }
                    //     // // Sending to parent
                    //     // if($request->receiver_role_id == 3){
                    //     //     $notificationdata->show_to_parent = 1;
                    //     //     $notificationdata->show_to_parent_id = $request->receiver_id;
                    //     //     // $notificationdata->show_to_all_parent = 0;
                    //     // }
                    //     $notificationdata->read_status = 0;
            
                    //     $notified = $notificationdata->save();
                    //     broadcast(new RealTimeMessage('$notification'));
            
                    //     // return back()->with('success', $msg);
                    //     return redirect()->to('student/enrollsuccess');
                    // } else {
                    //     return back()->with('fail', 'Something Went Wrong. Try Again Later');
                    // }
                
                // Redirect to success view
                return view('front-cms.bookingsuccess', compact('finalId','pass','email'))
                    ->with('success', 'Registration successful. Please check your mobile for OTP.');
            }
                
        }catch (\Exception $e) {
            return response()->json(['message' => 'You can`t register', 'error' => $e->getMessage()], 500);
        }
    }
 public function summarystore_rishi(Request $request)
    {
       // dd('jii');
        $validated = $request->validate([
            'start_date' => 'required|date',
            'theory_test_date' => 'nullable|date',
            'practical_test_date' => 'nullable|date',
            'first_name' => 'required|string',
            'surname' => 'required|string',
            'dob' => 'required|date',
            'contact_no' => 'required|string',
            'email' => 'required|email',
            'address_line1' => 'required|string',
            'address_line2' => 'nullable|string',
            'address_line3' => 'nullable|string',
            'driving_experience' => 'required|string',
            'how_heard_about_us' => 'required|string',
            'extended_test' => 'required|string',
        ]);

      $summary =  DB::table('bookings')->insert([
          'finalformid' => $request['finalform_id'],
        'start_date' => $validated['start_date'],
        'theory_test_date' => $validated['theory_test_date'],
        'practical_test_date' => $validated['practical_test_date'],
        'first_name' => $validated['first_name'],
        'surname' => $validated['surname'],
        'dob' => $validated['dob'],
        'contact_no' => $validated['contact_no'],
        'email' => $validated['email'],
        'address_line1' => $validated['address_line1'],
        'address_line2' => $validated['address_line2'],
        'address_line3' => $validated['address_line3'],
        'driving_experience' => $validated['driving_experience'],
        'how_heard_about_us' => $validated['how_heard_about_us'],
        'extended_test' => $validated['extended_test'],
        'created_at' => now(),
        'updated_at' => now()
    ]);
    // return redirect()->route('bookingsummary', ['id' => $request->input('finalform_id'), compact($request['finalform_id'])])
    //                  ->with('success', 'Your booking has been saved.');
  //return redirect()->back()->with('success', 'booked.');   
        // Redirect or return response
       // return redirect()->route('bookingsummary');
       $finalId = $request->input('finalform_id');
      
// return redirect()->route('bookingsummary', compact('finalId'))
//                  ->with('success', 'Your booking has been saved.');
 // return view('front-cms.bookingsummary', compact('finalId'));    
   return view('front-cms.bookingsuccess', compact('finalId'));

    }
    
     public function summary()
    {
         $id = session('userid')->id;
      
       // print_r($id);exit;
         $forms = Form::select('forms.*', 'price_details.*', 'finalforms.*', 'bookings.*')
        ->join('price_details', 'forms.id', '=', 'price_details.form_id')
        ->join('finalforms', 'finalforms.postcode', '=', 'price_details.id')
        ->join('bookings', 'bookings.finalformid', '=', 'finalforms.id')
        ->where('price_details.tutor_id', $id) 
        ->get();
// echo "<pre>";
// print_r($forms);exit;
    return view('tutor.summary', compact('forms'));
        
    }


}
