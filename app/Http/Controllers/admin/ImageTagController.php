<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ImageTag;
use JavaScript;
use App\CategoryTag;
use App\Image;

class ImageTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');   
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cate_tags = CategoryTag::where('category_id',Image::find($id)->category_id)->get();
        $tags = ImageTag::join('category_tags', 'category_tags.id', '=', 'image_tags.cate_tag_id')
                ->where('image_id', $id)
                ->select('image_tags.id', 'category_tags.name as name')
                ->get();
        JavaScript::put(['tags'=>$tags,  'cate_tags'=>$cate_tags,'image_id'=>$id]);
        return view('admin.imagetag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $image_id)
    {
        $tag = new ImageTag();
        $tag->image_id = $image_id;
        $tag->cate_tag_id = $request->cate_tag_id;
        $tag->save();
        return response()->json(['id'=>$tag->id]);
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
        $tag = ImageTag::find($id);
        $tag->cate_tag_id = $request->cate_tag_id;
        $tag->save();
        return response()->json(['status'=>true]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ImageTag::find($id)->delete();
        return response()->json(['status'=>true]);
    }
}
