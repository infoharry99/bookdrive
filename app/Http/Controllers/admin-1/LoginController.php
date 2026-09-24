<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        
        return view('admin.login');
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'loginpassword' => 'required',
        ]);
            $user = admin::where('email', '=', $request->username)->first();;
        


        if ($user) {
            // if (Hash::check($request->loginpassword, $user->password)) {
            if ($request->loginpassword == $user->password) {
                //  event(new Registered($user));

                $user_role = Auth::user();
                // dd($user->role_id);
                $request->session()->put('userid',$user);

                switch ($user->role_id) {
                    case 1:
                        // return view('admin.dashboard');
                        return redirect()->route('admin.dashboard');
                        break;
                    
                }
                // return redirect(RouteServiceProvider::HOME);
            }
            return back()->with('fail', 'Password does not match');
        } else {
            return back()->with('fail', 'Mobile No. Not Registered');
        }
    }
}
