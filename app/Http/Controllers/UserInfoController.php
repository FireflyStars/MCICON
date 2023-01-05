<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Download;
use App\UserViewedImages;
use File;

class UserInfoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('');
    }
    public function index(){
        $user = User::where('id', session('user_id'))->select(['first_name', 'last_name', 'email', 'image_url'])->first();
        $downloaded_images = Download::join('images', 'images.id', '=', 'downloads.image_id')
                                        ->where('downloads.user_id', session('user_id'))
                                        ->select('images.id', 'images.url', 'images.name','images.name_sp','images.name_pt','images.name_fr','images.name_du','images.name_du','downloads.created_at')
                                        ->get()->unique('image_id')->values()->all();
        $recent_images = UserViewedImages::join('images', 'images.id', '=', 'user_viewed_images.image_id')
                                        ->where('user_viewed_images.user_id', session('user_id'))
                                        ->select('images.id', 'images.url', 'images.name','images.name_sp','images.name_pt','images.name_fr','images.name_du','images.name_du')
                                        ->get()->unique('image_id')->values()->all();
        return response()->json(['user'=>$user, 'recentImages'=>$recent_images, 'downloadedImages'=>$downloaded_images]);
    }   

    public function userInfoUpdate(Request $request){
        $user = User::find(session('user_id'));
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($request->has('user_image')) {
            if($user->image_path != null)
                File::delete($user->image_path);
            $extention = $request->file('user_image')->extension();
            $request->file('user_image')->move(public_path('images/users/'), $user->id.'.'.$extention);
            $file_path = 'images/users/'.$user->id.'.'.$extention;
            $user->image_path = $file_path;
            $user->image_url = asset($file_path);
        }
        $user->save();            
        return response()->json(['status'=>true]);
    }
}
