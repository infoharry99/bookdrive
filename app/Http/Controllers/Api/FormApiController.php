<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Form;
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

class FormApiController extends Controller
{

    public function showForm()
    {
        return view('front-cms/advanceSearch');
    }


    public function AshowForm(Request $request)
    {
        return view('front-cms/finalSearch');
    }

    public function store(Request $request)
    {

        try {
            
            $validated = $request->validate([
                'postcode' => 'required',
                'mobile_number' => 'required',
                'opt_in' => 'nullable',
                'lessonstype' => 'required',
                'transmission' => 'required',
                'fasttrack' => 'nullable',
                'fasttrackdriving' => 'nullable',
                'bookedDrivingtest' => 'nullable',
                'spreadoutLesson' => 'nullable',
                'drivingExperience' => 'nullable',
                'drivingtestDate' => 'nullable',
                'lessonTime' => 'nullable',  
            ]);
    
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
            $postcode = $request->input('postcode'); 
            $first_part = explode(' ', $postcode)[0];
    
            $subjectExists = DB::table('subjects')->where('name', $first_part)->exists();
             if ($subjectExists) {
                    $tutors = DB::table('tutorsubjectmappings as s')
                        ->join('tutorprofiles as tp', 'tp.tutor_id', '=', 's.tutor_id')
                        ->leftJoin('subjects as sb', 'sb.id', '=', 's.subject_id')
                        ->select('s.tutor_id', 's.subject_id', 'tp.tutor_id', 'tp.rateperhour', 'tp.rateperhour2', 'tp.rateperhour3', 'sb.name as subject_name', 'tp.name as name')
                        ->where('sb.name', '=', $first_part)
                        ->where(function($query) {
                            $query->where('tp.rateperhour', '>', 0)
                                ->orWhere('tp.rateperhour2', '>', 0)
                                ->orWhere('tp.rateperhour3', '>', 0);
                        })->get();
                return response()->json([
                    'success' => true, 
                    'tutors' => $tutors,
                    'form' => $form,
                    'message' => "Success", 
                    'code' => 201
                ], 201);
                 
            }else {
                return response()->json([
                    'success' => true, 
                    'message' => "No matching subjects found for this postcode.", 
                    'code' => 400
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'data' => null,
                'message' => $e->getMessage(), 
                'code' => 400
            ], 400);
        }
    }
    
    
    public function storeprice(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(), [
                'formId' => 'required|numeric|exists:forms,id', 
                'tutorId' => 'required|numeric|exists:tutorprofiles,tutor_id', 
                'totalPrice' => 'required|numeric|min:0', 
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first()
                ], 400);
            }
    
            $existingPriceDetail = DB::table('price_details')
                                    ->where('form_id', $request->input('formId'))
                                    ->first();
            if ($existingPriceDetail) {
                DB::table('price_details')->where('form_id', $request->input('formId'))->delete();
            }

            $priceDetailId = DB::table('price_details')->insertGetId([
                'form_id' => $request->input('formId'),
                'tutor_id' => $request->input('tutorId'),
                'total_price' => $request->input('totalPrice'),
                'selected_hrs'=>$request->input('hourss'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            if(!empty($priceDetailId)){
                return response()->json([
                    'success' => true, 
                    'optid' => $priceDetailId,
                    'message' => "Price details stored successfully", 
                    'code' => 201
                ], 201);

            }else{
                return response()->json([
                    'success' => true, 
                    'message' => "Error in storing price details", 
                    'code' => 400
                ], 400);
            }
          
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'data' => null,
                'message' => $e->getMessage(), 
                'code' => 400
            ], 400);
        }
        return view('front-cms/finalSearch', compact('priceDetailId'));
    }


    public function storeforms(Request $request)
    {
        try {
            
                $validated = $request->validate([
                    'opt_in' => 'required',
                    'passed_theory' => 'nullable',
                    'theory_date' => 'nullable',
                    'book_quicker_theory' => 'nullable',
                    'zoom_training' => 'nullable',
                    'revision_app' => 'nullable',
                    
                ]);
                $finalId = DB::table('finalforms')->insertGetId([
                    'postcode' => $request['opt_in'],
                    'passed_theory' => $request['passed_theory'] ?? null,
                    'theory_date' => $request['theory_date'] ?? null,
                    'book_quicker_theory' => $request['book_quicker_theory'] ?? null,
                    'zoom_training' => $request['zoom_training'] ?? null,
                    'revision_app' => $request['revision_app'] ?? null,
                    'created_at' => now(), 
                    'updated_at' => now(), 
                ]);
                 $optid = $request['opt_in'];
            return response()->json([
                'success' => true, 
                'finalId' => $finalId,
                'optid' => $optid,
                'message' => "Success", 
                'code' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'data' => null,
                'message' => $e->getMessage(), 
                'code' => 400
            ], 400);
        }
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

                    $paymentdetails = new paymentdetails();
                    $paymentdetails->transaction_id = $order_id;
                    $paymentdetails->payment_mode = 'Credit Card';
                    $paymentdetails->amount = $price->total_price;
                    $paymentdetails->status = 1;
                    $test = $paymentdetails->save();

                    $studentpayment = new paymentstudents();
                    $studentpayment->transaction_id = $order_id;
                    $studentpayment->student_id = $userId;
                    $studentpayment->class_id = 1;
                    $studentpayment->subject_id = 2;
                    $studentpayment->tutor_id = $price->tutor_id;
                    $studentpayment->classes_purchased = 1;
                    $studentpayment->rate_per_hr = 40;
                    $spdres = $studentpayment->save();
            
                return view('front-cms.bookingsuccess', compact('finalId','pass','email'))
                    ->with('success', 'Registration successful. Please check your mobile for OTP.');
            }
                
        }catch (\Exception $e) {
            return response()->json(['message' => 'You can`t register', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function summarystore_rishi(Request $request)
    {
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
