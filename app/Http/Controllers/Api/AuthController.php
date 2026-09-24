<?php

namespace App\Http\Controllers\Api;
use Laravel\Passport\HasApiTokens;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\studentregistration;
class AuthController extends Controller
{
   
    public function register_old(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            //'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            
            'contact_number' => $request->contact_number,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
        ], 201);
    }
    
     public function deleteaccount(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required',
        ]);

        $user = StudentRegistration::where('id',$request->id)->first();

        if ($user) {
            $user = $user->update(['is_active'=>0]);
                return response()->json([
                    'message' => 'Delete Account SuccessFully!',
                ], 200);           
        } else {
            return response()->json(['message' => 'Student Not  Found.'], 404);
        }
    }
public function login(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'username' => 'required|email', // Ensure it's a valid email
        'password' => 'required',
    ]);

    // Attempt to find the student by email
    $user = StudentRegistration::where('email', $request->username)->first();

    if ($user) {
        // Check if the provided password matches the stored hashed password
        if (Hash::check($request->password, $user->password)) {
            // Generate an access token for the user
           // $token = $user->createToken('Student API Token')->accessToken;
        $tokenResult = $user->createToken('Student API Token');
        $token = $tokenResult->accessToken;

            // Return success response with token and user details
            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token,
            ], 200);
        } else {
            // Return error for incorrect password
            return response()->json(['message' => 'Password does not match.'], 401);
        }
    } else {
        // Return error for unregistered email
        return response()->json(['message' => 'Email not registered.'], 404);
    }
}

public function getValidationRules($role)
{
    $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required|min:4|max:13',
        'password' => 'required|min:8|max:50',
        'confpassword' => 'required|same:password',
       // 'expcheck' => 'required|accepted',
    ];

    if ($role === 'tutor') {
        unset($rules['expcheck']); // Tutors don't require expcheck
    }

    return $rules;
}

private function getValidationMessages()
{
    return [
        'name.required' => 'The name field is required.',
        'email.required' => 'The email field is required.',
        'email.email' => 'Please provide a valid email address.',
        'mobile.required' => 'The mobile field is required.',
        'mobile.min' => 'The mobile number must be at least 4 digits.',
        'mobile.max' => 'The mobile number must not exceed 13 digits.',
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters long.',
        'password.max' => 'The password must not exceed 50 characters.',
        'confpassword.required' => 'The confirm password field is required.',
        'confpassword.same' => 'The confirm password must match the password.',
        //'expcheck.required' => 'You must accept the experience check.', // Uncomment if needed
    ];
}
public function checkDuplicateUser($email, $mobile)
{
   // echo $email;exit;
    // Check if the user exists with either the provided email or mobile
    return StudentRegistration::where('email', $email)
                ->orWhere('mobile', $mobile)
                ->first(); // Returns the first matching user or null if no match
}


public function register(Request $request)
{
    $role = $request->registerAs;
    
    // Get validation rules based on role
    $rules = $this->getValidationRules($role);
   // print_r($rules);exit;

    // Explicitly create the validator
    $validator = Validator::make($request->all(), $rules, $this->getValidationMessages());

    // Check if validation fails
    if ($validator->fails()) {
        // If validation fails, return the errors to the previous page
        return back()->withErrors($validator)->withInput();
    }

    // Check for existing user with same email or mobile
    $existingUser = $this->checkDuplicateUser($request->email, $request->mobile);
    //echo $existingUser;exit;
   if ($existingUser) {
        // Return JSON response with error message if email or mobile already exists
        return response()->json([
            'status' => 'error',
            'message' => 'Email or Mobile Already Registered',
        ], 400);
    }

    // Register the user
    $user = $role === 'student' ? new studentregistration() : new tutorregistration();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->mobile = $request->mobile;
     $user->role_id = 3;
     $user->is_active=1;
    if ($role === 'student') {
        $user->class_id = $request->class_id ?? 0;  // Example field for students
    }

    if ($role === 'tutor') {
        $user->specialization = $request->specialization ?? '';  // Example field for tutors
    }
    
    $user->password = Hash::make($request->password);
    $user->save();

    // Create user profile and send notifications
   // $this->createProfile($request, $user, $role);
    $this->sendWelcomeMail($user->name, $user->email, $user->mobile, $request->password);
  //  $this->sendSms($user->mobile, rand(1000, 9999));

    // return $role === 'student'
    //     ? view('common.student-mobile-verify', ['mobile' => $user->mobile])->with('success', 'Registration successful.')
    //     : redirect('tutor/dashboard');
     return response()->json([
        'status' => 'success',
        'message' => 'Registration successful.',
        'user' => [
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'role' => $role,
        ],
    ], 200);
}
// Add this method inside your AuthController

private function prepareUserData(Request $request, $role)
{
    $userData = [
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        // You can add additional fields as required by your application
    ];
   
    if ($role === 'student') {
        // For student role, you can add specific fields if needed
        $userData['class_id'] = $request->class_id ?? 0;  // Example of optional field for students
    }

    if ($role === 'tutor') {
        // For tutor role, you can add specific fields if needed
        $userData['specialization'] = $request->specialization ?? '';  // Example field for tutors
    }
//  echo 'ji';
// print_r($userData);exit;
    return $userData;
}

private function sendWelcomeMail($name, $email, $mobile, $password)
{
    $details = [
        'name' => $name,
        'mobile' => $mobile,
        'password' => $password,
        'mailtype' => 1,
    ];

    try {
        Mail::to($email)->send(new SendMail($details));
    } catch (\Exception $e) {
        // Log the error and continue
        Log::error('Email sending failed: ' . $e->getMessage());
    }
}



    public function login_old(Request $request)
    {
    //   /  dd('hi');
        // Validate the request
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string|min:8',
        // ]);
        $data = $request->only('email', 'password');
        $validator = Validator::make($data, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
       // echo 'ji';exit;
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed, get the authenticated user
            $user = Auth::user();

            // Generate a personal access token
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials.'], 401);
    }

    public function disableUser($id)
    {
       
        // Validate that the ID is an integer
        if (!is_numeric($id) || $id <= 0) {
            return response()->json(['error' => 'Invalid user ID'], Response::HTTP_BAD_REQUEST);
        }
    
        // Find the user by ID
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
    
        // Check if the user is already disabled
        if ($user->status == 0) {
            return response()->json(['message' => 'User is already disabled'], Response::HTTP_OK);
        }
    
        // Update the user's status to 0 (disabled)
        $user->status = 0;
        $user->save();
    
        // Return a success response
        return response()->json(['message' => 'User status updated to disabled'], Response::HTTP_OK);
    }
}
