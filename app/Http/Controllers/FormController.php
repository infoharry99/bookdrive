<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tutorregistration;
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
use App\Mail\TutorAssignedMail;
use Illuminate\Support\Facades\Http;
use App\Mail\StudentAssignedMail;


class FormController extends Controller
{
    // Show the form
    public function showForm()
    {
        return view('front-cms/advanceSearch');
    }


    public function AshowForm(Request $request)
    {
        return view('front-cms/finalSearch');
    }

    // Store form data
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the form data
        // $validated = $request->validate([
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
        
        $postcode = $request->input('postcode'); 
        $first_part = explode(' ', $postcode)[0];

        $subjectExists = DB::table('subjects')->where('name', $first_part)->exists();
        if($request->lessonstype == "intensive") {
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
            
            $admin = 1; 
            return view('front-cms/advanceSearch', compact('tutors','form','admin'));
        }else if ($subjectExists) {
                // $tutors = DB::table('tutorsubjectmappings as s')
                //             ->join('tutorprofiles as tp', 'tp.tutor_id', '=', 's.tutor_id')
                //             ->leftJoin('subjects as sb', 'sb.id', '=', 's.subject_id')
                //             ->leftjoin('tutorreviews as t', 't.tutor_id','s.tutor_id')
                //             ->select('s.tutor_id', 's.subject_id', avg('t.ratings'),'tp.tutor_id', 'tp.rateperhour', 'tp.rateperhour2', 'tp.rateperhour3', 'sb.name as subject_name', 'tp.name as name')
                //             ->where('sb.name', '=', $first_part)
                //             ->where(function($query) {
                //                 $query->where('tp.rateperhour', '>', 0)
                //                     ->orWhere('tp.rateperhour2', '>', 0)
                //                     ->orWhere('tp.rateperhour3', '>', 0);
                //             })->get();
                
               

                    $tutors = DB::table('tutorsubjectmappings as s')
                        ->join('tutorprofiles as tp', 'tp.tutor_id', '=', 's.tutor_id')
                        ->leftJoin('subjects as sb', 'sb.id', '=', 's.subject_id')
                        ->leftJoin('tutorreviews as t', 't.tutor_id', '=', 's.tutor_id')
                        ->select(
                            's.tutor_id',
                            's.subject_id',
                            'tp.rateperhour',
                            'tp.rateperhour2',
                            'tp.rateperhour3',
                            'sb.name as subject_name',
                            'tp.name as name',
                            DB::raw('AVG(t.ratings) as average_rating')
                        )
                        ->where('sb.name', '=', $first_part)
                        ->where(function ($query) {
                            $query->where('tp.rateperhour', '>', 0)
                                ->orWhere('tp.rateperhour2', '>', 0)
                                ->orWhere('tp.rateperhour3', '>', 0);
                        })
                        ->groupBy(
                            's.tutor_id',
                            's.subject_id',
                            'tp.rateperhour',
                            'tp.rateperhour2',
                            'tp.rateperhour3',
                            'sb.name',
                            'tp.name'
                        )
                        ->get();

                // dd($tutors);
                $admin = 0; 
               return view('front-cms/advanceSearch', compact('tutors','form','admin'));
             
        }else {
      
            return redirect()->back()->with('error', 'No matching subjects found for this postcode.');
        }
    }
    
    
    public function storeprice(Request $request)
    {
  
        $validator = Validator::make($request->all(), [
            'formId' => 'required|numeric|exists:forms,id', // Form ID should exist in the forms table
            'tutorId' => 'required',
            'totalPrice' => 'required|numeric|min:0', 
        ]);

        // Check if the validation failed
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 400);
        }

        if($request->has('planId') && !empty($request->input('planId'))) {
            $update = Form::where('id', $request->input('formId'))->update(['postcode' => $request->input('planId')]);
        }
        $existingPriceDetail = DB::table('price_details')
                             ->where('form_id', $request->input('formId'))
                             ->first();
                             
        if ($existingPriceDetail) {
            DB::table('price_details')->where('form_id', $request->input('formId'))->delete();
        }
        try {
                $priceDetailId = DB::table('price_details')->insertGetId([
                    'form_id' => $request->input('formId'),
                    'tutor_id' => $request->input('tutorId'),
                    'total_price' => $request->input('totalPrice'),
                    'selected_hrs'=>$request->input('hourss'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        } catch (\Exception $e) {
            \Log::error('Error inserting into price_details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the booking.');
        }

        return view('front-cms/finalSearch', compact('priceDetailId'));
    }


    public function storeforms(Request $request)
    {
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
        $optid =$request['opt_in'];
        return view('front-cms.bookingsummary', compact('finalId','optid'));
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
                   
        
        $validated = $request->validate([
            'start_date' => 'required|date',
        
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
            'theroy' => 'nullable|string|max:255',
            'licence' => 'nullable|string|max:255',
            'prefered_test_center' => 'nullable|string|max:255',
            'certificate_number' => 'nullable|string|max:255',
            'pass_theory' => 'nullable|string|max:255',
        ]);
        try {
                // Insert into bookings table
            DB::table('bookings')->insert([
                'finalformid' => $request['finalform_id'],
                'start_date'  => $validated['start_date'],
                // 'theory_test_date'    => $validated['theory_test_date'],
                // 'practical_test_date' => $validated['practical_test_date'],
                'first_name' => $validated['first_name'],
                'surname'    => $validated['surname'],
                'dob'        => $validated['dob'],
                
               'theroy' => $request->input('theroy'),
                'licence' => $request->input('licence'),
                'prefered_test_center' => $request->input('prefered_test_center'),
                'certificate_number' => $request->input('certificate_number'),
                'pass_theory' => $request->input('pass_theory'),
                
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

                return response()->json(['message' => 'Email already registered. Please use a different email address.'], 500);
                return back()->with('fail', 'Email already registered. Please use a different email address.');

                $id = session('userid')->id;
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
                        'email' => $request->email,
                        'password' => $request->password,
                        'mailtype' => 1
                    ];
                    Mail::to($request->email)->send(new SendMail($details));
                    
                    $name = $validated['first_name'] . ' ' . $validated['surname'];
                    $phone =$request->contact_no ?? '0712345678';
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
                    $selectedSlotIds = 1;
                    $contactadmin = $request->contactadmin;
                    $optid = $request->optid;
                    
                    $price = DB::table('price_details')->where('id', $optid)->first();
                    $order_id = 'order'.uniqid().rand(10000,99999);
                    
                    $username = 'RYwy3p5Gc1OSmA8c'; 
                    $password = 'O8jW0H3HcAs8w1OvwIAFKX0JWaZujcu5rmUddRK0ZnPHUqbLFzRcdhOJ4nAyGU0k'; 
                    $amt      = $price->total_price;
                    $purpose  = $order_id?? null;
                    
                    if ($price) {
                        DB::table('price_details')->where('id', $optid)
                            ->update(['student_id' => $userId, 'finaformid' => $finalId]);
                    
                        DB::table('forms')->where('id', $price->form_id)
                            ->update(['student_id' => $userId, 'finaformid' => $finalId]);
                    }
                    
                  $forms_id = DB::table('forms')
                            ->leftJoin('subjects', DB::raw('CONVERT(forms.postcode USING utf8mb4) COLLATE utf8mb4_unicode_ci'), '=', DB::raw('subjects.name COLLATE utf8mb4_unicode_ci'))
                            ->where('forms.id', $price->form_id)
                            ->select('forms.*', 'subjects.id as subject_id')
                            ->first();

                 
                    $paymentdetails = new paymentdetails();
                    $paymentdetails->transaction_id = $order_id;
                    $paymentdetails->payment_mode = 'Credit Card';
                    $paymentdetails->amount = $price->total_price;
                    $paymentdetails->status = 0;
                    $test = $paymentdetails->save();
        
                    $studentpayment = new paymentstudents();
                    $studentpayment->transaction_id = $order_id;
                    $studentpayment->student_id = $userId;
                    $studentpayment->class_id = 1;
                    $studentpayment->subject_id = $forms_id->subject_id;
                    $studentpayment->tutor_id = $price->tutor_id;
                    $studentpayment->classes_purchased = $price->selected_hrs;
                    $studentpayment->free_class = $price->selected_hrs;
                    $studentpayment->rate_per_hr = 40;
                    $spdres = $studentpayment->save();

                    
                    $merchantTransactionId = $order_id; 
                    $amount = $price->total_price;
                    $currency = "GBP";

                    // $memberId = env('TRANSACTWORLD_MEMBER_ID');
                    // $totype = env('TRANSACTWORLD_TOTYPE');
                    // $merchantRedirectUrl = env('TRANSACTWORLD_REDIRECT_URL');
                    // $secureKey = env('TRANSACTWORLD_CHECKSUM_KEY');

                    // $checksumString = "{$memberId}|{$totype}|{$amount}|{$merchantTransactionId}|{$merchantRedirectUrl}|{$secureKey}";
                    // $checksum = md5($checksumString);

                    // $data = [
                    //     'memberId' => '16265',
                    //     'language' => env('TRANSACTWORLD_LANGUAGE'),
                    //     'checksum' => $checksum,
                    //     'totype' => $totype,
                    //     'merchantTransactionId' => $merchantTransactionId,
                    //     'amount' =>  $price->total_price,
                    //     'TMPL_AMOUNT' =>  $price->total_price,
                    //     'orderDescription' => 'Test Transaction',
                    //     'merchantRedirectUrl' => $merchantRedirectUrl,
                    //     'notificationUrl' => env('TRANSACTWORLD_NOTIFICATION_URL'),
                    //     'country' => 'UK',
                    //     'city' => 'Aston',
                    //     'state' => 'NA',
                    //     'postcode' => 'CH5 3LJ',
                    //     'street' => '19 Scrimshire Lane',
                    //     'telnocc' => '+44',
                    //     'phone' => '07730432996',
                    //     'email' =>  $email ?? 'john.d@domain.com',
                    //     'ip' => $request->ip(),
                    //     'currency' => $currency,
                    //     'TMPL_CURRENCY' => $currency,
                    //     'reservedField1' => ''
                    // ];
                    // return view('payment.redirect', compact('data'));



                    // $response = Http::withBasicAuth($username, $password)
                    // ->withHeaders([
                    //     'Content-Type' => 'application/vnd.worldpay.payment_pages-v1.hal+json',
                    //     'Accept' => 'application/vnd.worldpay.payment_pages-v1.hal+json',
                    // ])
                    // ->post('https://try.access.worldpay.com/payment_pages', [
                    //     'transactionReference' => $purpose,
                    //     'merchant' => [
                    //         'entity' => 'PO4057534139',
                    //     ],
                    //     'narrative' => [
                    //         'line1' => 'Deepesh-001',
                    //     ],
                    //     'value' => [
                    //         'currency' => 'GBP',
                    //         'amount' => $amt *100, 
                    //     ],
                    //   "resultURLs" => array(
                    //     "successURL" => "https://bookdriver.sofinish.co.uk/worldpay/success?order_id=$order_id",
                    //     "pendingURL" => "https://bookdriver.sofinish.co.uk/worldpay/pending?order_id=$order_id",
                    //     "failureURL" => "https://bookdriver.sofinish.co.uk/worldpay/failure?order_id=$order_id",
                    //     "errorURL"  =>   "https://bookdriver.sofinish.co.uk/worldpay/error?order_id=$order_id",
                    //     "cancelURL" =>  "https://bookdriver.sofinish.co.uk/worldpay/cancel?order_id=$order_id",
                    //     "expiryURL" =>  "https://bookdriver.sofinish.co.uk/worldpay/expiry?order_id=$order_id"
                    //   ),
                    // ]);
        
                    // // dd($response);
                    // if($response->successful()) {
                    //     $responseData = $response->json();
                    //     $paymentUrl = $responseData['url'];
                    //     return redirect()->away($paymentUrl);
                    // }else{
                    //      return redirect()->back();
                    // }

                      
                    // // }
                    
            
                // Redirect to success view
                return view('front-cms.bookingsuccess',compact('finalId','pass','email','amount','currency','order_id'))
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
        return view('front-cms.bookingsuccess', compact('finalId'));

    }
    
    public function summary()
    {
         $id = session('userid')->id;
         $forms = Form::select('forms.*', 'price_details.*', 'finalforms.*', 'bookings.*')
                ->join('price_details', 'forms.id', '=', 'price_details.form_id')
                ->join('finalforms', 'finalforms.postcode', '=', 'price_details.id')
                ->join('bookings', 'bookings.finalformid', '=', 'finalforms.id')
                ->where('price_details.tutor_id', $id) 
                ->get();
             
        return view('tutor.summary', compact('forms'));
        
    }

    public function adminsummary()
    {
        //  $forms = Form::select('forms.*', 'forms.postcode as plan_id','price_details.*','price_details.total_price as amt', 'finalforms.*', 'bookings.*')
        //          ->join('price_details', 'forms.id', '=', 'price_details.form_id')
        //         ->join('finalforms', 'finalforms.postcode', '=', 'price_details.id')
        //         ->join('bookings', 'bookings.finalformid', '=', 'finalforms.id')
        //         ->where('forms.lessonstype', 'intensive') 
        //         ->where('orderBy', 'asc')
        //         ->get();
        $forms = Form::select(
            'forms.*',
            'forms.postcode as plan_id',
            'price_details.*',
            'price_details.total_price as amt',
            'finalforms.*',
            'bookings.*'
        )
        ->join('price_details', 'forms.id', '=', 'price_details.form_id')
        ->join('finalforms', 'finalforms.postcode', '=', 'price_details.id')
        ->join('bookings', 'bookings.finalformid', '=', 'finalforms.id')
        ->where('forms.lessonstype', 'intensive')
        ->orderBy('forms.id', 'desc')   // <-- correct orderBy
        ->get();
        return view('admin.summary', compact('forms'));
    }
    
    public function admintutorslist()
    {
            $tutors = tutorregistration::select(
                'tutorregistrations.id as tutor_id',
                'tutorregistrations.name as tutor_name',
                'tutorregistrations.mobile as tutor_mobile',
                'tutorregistrations.email as tutor_email',
                'tutorregistrations.is_active as tutor_status',
                'tutorprofiles.rateperhour as rate',
                'tutorprofiles.rateperhour2 as rate2',
                'tutorprofiles.rateperhour3 as rate3',
                'tutorprofiles.driver_payment as driver_payment',
                'tutorprofiles.badge_expiry_date as badge_expiry_date',
                'tutorprofiles.badge_image as badge_image',
                'tutorprofiles.admin_commission as admin_commission',
                'tutorprofiles.id as rate_id',
                'tutorregistrations.created_at'
            )
            ->leftJoin('tutorsubjectmappings', 'tutorsubjectmappings.tutor_id', '=', 'tutorregistrations.id')
            ->leftJoin('tutorprofiles', 'tutorprofiles.tutor_id', '=', 'tutorregistrations.id')
            ->groupBy(
                'tutorregistrations.id',
                'tutorregistrations.name',
                'tutorregistrations.mobile',
                'tutorregistrations.email',
                'tutorregistrations.is_active',
                'tutorprofiles.rateperhour',
                'tutorprofiles.rateperhour2',
                'tutorprofiles.rateperhour3',
                'tutorprofiles.driver_payment',
                'tutorprofiles.badge_image',
                'tutorprofiles.badge_expiry_date',
                'tutorprofiles.admin_commission',
                'tutorprofiles.id',
                'tutorprofiles.badge_expiry_date',
                'tutorprofiles.badge_image',
                'tutorregistrations.created_at'
            )
            ->orderBy('tutorregistrations.created_at', 'desc')
            ->get();
        return response()->json(['tutors' => $tutors]);
    }
    
    public function assignTutor(Request $request) {
     
        $request->validate([
            'form_id' => 'required',
            'tutor_id' => 'required',
        ]);
        $sid =  $request->sid;
        $form = DB::table('price_details')->where('form_id', $request->form_id)->update(['tutor_id' => $request->tutor_id]);
       
        DB::table('paymentstudents')->where('student_id', $sid)->update(['tutor_id' => $request->tutor_id]);
    
        $student = DB::table('studentregistrations')->select('*')->where('id',$request->sid)->first();
        $tutor   = DB::table('tutorregistrations')->select('*')->where('id',$request->tutor_id)->first();
    
        // Send emails
        Mail::to($tutor->email)->send(new TutorAssignedMail($tutor, $student));
        Mail::to($student->email)->send(new StudentAssignedMail($tutor, $student));

        return response()->json(['success' => true]);
    }


}
