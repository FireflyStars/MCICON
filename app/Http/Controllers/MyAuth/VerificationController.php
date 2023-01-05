<?php

namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function verify($token)
    {
        if(session()->has('token')){
            if(session('token') == $token){
                session()->forget('token');
                return response()->json(['status'=>true]);
            }else{
                return response()->json(['status'=>false]);
            }
        }else{
            return response()->json(['status'=>false]);
        }
    }
}
