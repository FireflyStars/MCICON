<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JavaScript;
use App\Image;
use Chumper\Zipper\Zipper;
use File;
use App\Download;
use App\ImageTag;
use App\PopularDownload;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['download', 'sendMostDownloadedImages', 'sendCategoryGallery',
        'sendCategoryGalleryByImageId']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cate_id)
    {
        $images = Image::where( 'category_id', $cate_id)->get();
        JavaScript::put(['cate_id'=> $cate_id, 'images'=> $images]);
        return view('admin.image');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cate_id)
    {      
        $name = $request->file('image_file')->getClientOriginalName();
        $request->file('image_file')->move(public_path('images/categories/'.$cate_id), $name);
        $file_path = 'images/categories/'.$cate_id.'/'.$name;
        $dir_path = 'images/categories/'.$cate_id.'/';
        $zip = new Zipper;

        $zip->make(public_path($file_path))->extractTo($dir_path);
        $file_list = $zip->make(public_path($file_path))->listFiles();
        $zip->close();
        for ($i=0; $i < count($file_list); $i++) { 
            if(explode('.', $file_list[$i])[1] == 'svg'){
                $image = new Image;
                $image->category_id = $cate_id;
                $image->path = $dir_path.$file_list[$i];
                $image->url = asset($dir_path.$file_list[$i]);
    
                if ($request->name != '')
                    $image->name = $request->name;
                else
                    $image->name = explode('.', $file_list[$i])[0];
                if ($request->name_sp != '')
                    $image->name_sp = $request->name_sp;
                if ($request->name_pt != '')
                    $image->name_pt = $request->name_pt;
                if ($request->name_fr != '')
                    $image->name_fr = $request->name_fr;
                if ($request->name_du != '')
                    $image->name_du = $request->name_du;
                if ($request->name_it != '')
                    $image->name_it = $request->name_it;
    
                $image->ext = explode('.', $file_list[$i])[1];
                $image->save();
            }
        }        
        File::delete($file_path);
        return response()->json(['status'=>true]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($image_id)
    {
        $cate_id = Image::find($image_id)->category_id;
        $user_id = session('user_id');
        $download = new Download;
        $download->user_id = $user_id;
        $download->image_id = $image_id;
        $download->save();
        if(PopularDownload::where('image_id', $image_id)->count()){
            $popular_download = PopularDownload::where('image_id', $image_id)->first();
            $popular_download->count = $popular_download->count + 1;
            $popular_download->save(); 
            $popular_download->save(); 
        }else{
            $popular_download = new PopularDownload;
            $popular_download->image_id = $image_id;
            $popular_download->count = 1;
            $popular_download->save(); 
        }
        
        $image = Image::find($image_id);
        $files = [];
        $files[0] = public_path($image->path);
        $files[1] = public_path(str_replace('.svg', '.jpg' , $image->path));
        $files[2] = public_path(str_replace('.svg', '.eps' , $image->path));
        $images = glob('images/categories/'.$cate_id.'/*.zip');
        for($i = 0 ; $i< count($images); $i += 1){
            File::delete($images[$i]);
        }
        $zip = new Zipper();
        $zip->make('images/categories/'.$cate_id.'/'.$image->name.'.zip')->add($files);        
        $zip->close();
        return response()->download(public_path('images/categories/'.$cate_id.'/'.$image->name.'.zip'))->deleteFileAfterSend(true);
    }

    /**
     * Send most downloaded images
     */
    public function sendMostDownloadedImages()
    {
        $images = PopularDownload::join('images', 'image_id', '=', 'images.id')
                    ->select(['popular_downloads.count','images.id', 'images.url', 'images.category_id'])
                    ->get()->sortByDesc('count')->values()->all();
        return response()->json(['images'=>$images]);

    }

    /**
     * Send most downloaded images
     */
    public function sendCategoryGallery($cate_id){
        $gallery = Image::where('category_id', $cate_id)->get();
        return response()->json(['gallery'=>$gallery]);
    }    

    /**
     * Send most downloaded images
     */
    public function sendCategoryGalleryByImageId($image_id){
        $image = Image::find($image_id);
        $cate_id = $image->category_id;
        $related_keys = ImageTag::join('category_tags', 'category_tags.id', '=', 'image_tags.cate_tag_id')
                ->where('image_id', $image_id)
                ->select('category_tags.name as name', 'category_tags.category_id as cate_id')
                ->get();

        $image_tags = ImageTag::where('image_id', $image_id)->select(['cate_tag_id'])->get();        
        $tag_list = [];
        foreach ($image_tags as $key => $tag) {
            # code...
            $tag_list[$key] = $tag->cate_tag_id;
        }        

        $similar_images = ImageTag::join('images', 'images.id', '=', 'image_tags.image_id')
                    ->whereIn('cate_tag_id', $tag_list)
                    ->select(['images.id', 'images.url'])
                    ->get()->unique('id')->values()->all();
        $gallery = Image::where('category_id', $cate_id)->get();
        return response()->json([ 'cate_id' => $cate_id, 'gallery'=>$gallery, 'relatedKeys'=> $related_keys, 'similarImages'=>$similar_images]);
    }    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cate_id, $image_id)
    {
        if($request->hasFile('image_file')){
            $image = Image::find($image_id);
            $files = [];
            $files[0] = public_path($image->path);
            $files[1] = public_path(str_replace('.svg', '.jpg' , $image->path));
            $files[2] = public_path(str_replace('.svg', '.eps' , $image->path));            
            for ($i=0; $i < 3; $i++) { 
                File::delete($files[$i]);
            }
        }else{
            $image = Image::find($image_id);
            $image->name = $request->name;
            $image->name_sp = $request->name_sp;
            $image->name_pt = $request->name_pt;
            $image->name_fr = $request->name_fr;
            $image->name_du = $request->name_du;
            $image->name_it = $request->name_it;            
            $image->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($image_id)
    {
        $image = Image::find($image_id);
        $files = [];
        $files[0] = public_path($image->path);
        $files[1] = public_path(str_replace('.svg', '.jpg' , $image->path));
        $files[2] = public_path(str_replace('.svg', '.eps' , $image->path));            
        for ($i=0; $i < 3; $i++) { 
            File::delete($files[$i]);
        }
        return response()->json(['status'=>true]);
    }

    /**
     * Search Images
     */

     public function searchImages( Request $request){
         if($request->lang == 'en'){
             $searchImages = Image::where('name', $request->name)
                                    ->orWhere('name', 'like', '%'.$request->name.'%')
                                    ->limit(10)->get();
            return response()->json(['searched_images'=>$searchImages]);
         }else if($request->lang == 'sp'){
             $searchImages = Image::where('name_sp', $request->name)
                                    ->orWhere('name_sp', 'like', '%'.$request->name.'%')
                                    ->limit(10)->get();
            return response()->json(['searched_images'=>$searchImages]);
         }else if($request->lang == 'pt'){
             $searchImages = Image::where('name_pt', $request->name)
                                    ->orWhere('name_pt', 'like', '%'.$request->name.'%')
                                    ->limit(10)->get();
            return response()->json(['searched_images'=>$searchImages]);
         }else if($request->lang == 'fr'){
             $searchImages = Image::where('name_fr', $request->name)
                                    ->orWhere('name_fr', 'like', '%'.$request->name.'%')
                                    ->limit(10)->get();
            return response()->json(['searched_images'=>$searchImages]);
         }else if($request->lang == 'du'){
             $searchImages = Image::where('name_du', $request->name)
                                    ->orWhere('name_du', 'like', '%'.$request->name.'%')
                                    ->limit(10)->get();
            return response()->json(['searched_images'=>$searchImages]);
         }else{
             $searchImages = Image::where('name_it', $request->name)
                                    ->orWhere('name_it', 'like', '%'.$request->name.'%')
                                    ->limit(10)->get();
            return response()->json(['searched_images'=>$searchImages]);
         }
     }
}
