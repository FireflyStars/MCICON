<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoryTag;
use JavaScript;
use App\ImageTag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cate_id)
    {
        $tags = CategoryTag::where('category_id', $cate_id)->get();
        Javascript::put(['tags'=> $tags, 'cateId'=> $cate_id]);
        return view('admin.categorytag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cate_id)
    {
        $tag = new CategoryTag();
        $tag->category_id = $cate_id;
        $tag->name = $request->name;
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
        $tag = CategoryTag::find($id);
        $tag->name = $request->name;
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
        CategoryTag::find($id)->delete();
        $image_tags = ImageTag::where('cate_tag_id', $id)->get();
        foreach ($image_tags as $item) {
            $item->delete();
        }
        return response()->json(['status'=>true]);
    }
}
