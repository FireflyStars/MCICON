<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Privacy;

class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['sendDataToClient']);   
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.privacy');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Privacy::find($id);
        return response()->json(['data'=>$data]);
    }
    /**
     *  Send about us content to client
     *  */
    public function sendDataToClient(){
        $data = Privacy::find(1);
        return response()->json(['content'=> $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Privacy::find($id);
        if ($request->lang == 1) 
            $data->content = $request->content;
        else if($request->lang == 2)
            $data->content_sp = $request->content;
        else if($request->lang == 3)
            $data->content_pt = $request->content;
        else if($request->lang == 4)
            $data->content_fr = $request->content;
        else if($request->lang == 5)
            $data->content_it = $request->content;
        else
            $data->content_du = $request->content;
        
        $data->save();
    }

}
