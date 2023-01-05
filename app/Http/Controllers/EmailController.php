<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public $email = 'zzzac95zzzua@gmail.com';
    /**
     * Load homepage
     */
    public function index(){

    }

    public function sendMessage(Request $request){
        $validator = $this->getValidator($request->all());
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'errors'=>$validator->errors()]);
        }else{
            Mail::to($this->email)->send(new ContactEmail($request->name, $request->email, $request->msg));
            return response()->json(['status'=> true]);
        }
    }    
    public function getValidator($data){
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'msg' => ['required', 'string'],
        ]);
    }    
}
