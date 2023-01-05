<?php

namespace App\Http\Controllers\MyAuth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class RegisterController extends Controller
{
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

    public function register(Request $request){
        // $token = str_random(100);
        // $request->session()->put('veryfy_token', $token);
        // Mail::to($request->email)->send(new VerifyEmail($request->fisrname, $token));
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors'=> $validator->errors()]);
        }else{
            $user = new User();
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $token = str_random(100);
            $request->session()->put('veryfy_token', $token);
            $request->session()->put('user_email', $user->email);
            Mail::to($user->email)->send(new VerifyEmail($user->firstname, $token));
            return response()->json(['status' =>true]);
        }          
    }

    public function reSendVerifyEmail(Request $request){
        $user = User::where('email', $request->session()->get('user_email'))->first();
        $token = str_random(100);
        Mail::to($user->email)->send(new VerifyEmail($user->firstname, $token));
        return response()->json(['status' =>true]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }
}
