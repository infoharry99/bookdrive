<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class StudentAuthenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next): Response
    { 
        if (session('userid')) {            
            // dd(session('userid')->name);
            if(session('userid')->role_id == '3'){
               // Auth::logout(); 
               return $next($request);
            }
            else{
                return redirect()->intended(route('studentlogin'))->with('fail', 'Please, Login to access this page.');
                // if($request->route()->named("sale.*")){
                // //    $todaysOffloading = Offloading::where('salesman_id', Auth::id())->whereBetween('created_at',[date('Y-m-d'), date('Y-m-d 23:59:59')])->count();
                // //     if($todaysOffloading >= 1){
                //         return redirect()->back()->with('message', 'Sorry, you are not authorized to do more sales for today.');
                //     // }
                // }
            } 
        }
        else {
            return redirect()->intended(route('studentlogin'))->with('fail', 'Please, Login to access this page.');

        } 
        // return $next($request);
    }
}
