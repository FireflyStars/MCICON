<?php

namespace App\Http\Controllers\MyAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    public function index(){
        return view('app');
    }
    
    public function login(Request $request){
        $validator = $this->getValidator($request->all());
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors'=> $validator->errors()]);
        }else{
            $user = User::where('email', $request->email)->first();
            if($user->email == $request->email){
                if (Hash::check($request->password, $user->password)) {
                    if($user->email_verified_at != null){
                        session(['user_id'=> $user->id]);
                        if($user->role == 1){
                            session(['admin'=> true]);
                            return response()->json(['status'=>5]);
                        }
                        else
                            return response()->json(['status'=>4]);
                    }else{
                        return response()->json(['status'=>3]);
                    }
                }else{
                    return response()->json(['status'=>2]);
                }
            }else{
                return response()->json(['status'=>1]);
            }
        }            
    }

    public function getValidator($data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required', 'string'],
        ]);
    }

    public function sendUserStatus(){
        if(session()->has('user_id')){
            return response()->json(['status'=>true]);
        }else
            return response()->json(['status'=>false]);
    }

    public function logout(){
        session()->forget('user_id');
        return response()->json(['status'=> true]);
    }
    
    public function adminLogout(){
        session()->forget('user_id');
        return redirect()->route('home');
    }
    
}
