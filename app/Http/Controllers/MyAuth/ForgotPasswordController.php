<?php

namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function index(){
        return view('app');
    }

    /**
     * SendsPasswordResetEmails
     */
    public function SendsPasswordResetEmails(Request $request){
        $validator = $this->getEmailValidator($request->all());
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors'=> $validator->errors()]);
        }else{
            $token = str_random(150);
            $pwd = new PasswordReset;
            $pwd->token = $token;
            $pwd->email = $request->email;
            $pwd->save();
            Mail::to($request->email)->send(new PasswordResetEmail($token));
            return response()->json(['status' =>true]);            
        }
    }

    /**
     * Generate Validator Rule for Email
     */
    public function getEmailValidator($data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
        ]);
    }    
    
}
