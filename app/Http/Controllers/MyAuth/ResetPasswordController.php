<?php

namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PasswordReset;
use App\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
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
     * Password Reset 
     */
    public function passwordReset(Request $request){
        $validator = $this->getPasswordValidator($request->all());
        if($validator->fails()){
            return response()->json(['status'=> false, 'errors'=> $validator->errors()]);
        }else{
            $password_reset = PasswordReset::where('token', $request->token)->first();
            $email = $password_reset->email;
            $user = User::where('email', $email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            $password_reset->delete();
            return response()->json(['status'=>true]);
        }
    }    
    /**
     * Generate Validator Rule for Password
     */
    public function getPasswordValidator($data){
        return Validator::make($data, [
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }    
}
