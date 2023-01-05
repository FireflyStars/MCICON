<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['sendImages']);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->file('image_file')->getClientOriginalName();
        $request->file('image_file')->move(public_path('images/cateOwn/'), $name);
        $file_path = 'images/cateOwn/'.$name;

        $category = new Category;
        $category->name = $request->name_en;
        $category->name_sp = $request->name_sp;
        $category->name_pt = $request->name_pt;
        $category->name_fr = $request->name_fr;
        $category->name_du = $request->name_du;
        $category->name_it = $request->name_it;
        $category->path = $file_path;
        $category->url = asset($file_path);
        $category->save();
        return response()->json(['status'=> true]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $categories = Category::all();
        return response()->json(['cate' => $categories]);
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
        $category = Category::find($id);
        $category->name = $request->name_en;
        $category->name_sp = $request->name_sp;
        $category->name_pt = $request->name_pt;
        $category->name_fr = $request->name_fr;
        $category->name_du = $request->name_du;
        $category->name_it = $request->name_it;
        if ($request->has('image_file')) {
            File::delete($category->path);
            $name = $request->file('image_file')->getClientOriginalName();
            $request->file('image_file')->move(public_path('images/cateOwn/'), $name);
            $file_path = 'images/cateOwn/'.$name;
            $category->path = $file_path;
            $category->url = asset($file_path);
        }
        $category->save();
        return response()->json(['status'=> true]);        
    }

    /**
     * send category own images to client
     */
    public function sendImages(){
        $images = Category::select(['id', 'name', 'name_sp', 'name_pt', 'name_fr', 'name_du', 'name_it', 'url'])
                            ->get();
        return response()->json(['images'=>$images]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        $images = Image::where('category_id', $id)->get();
        foreach ($images as $image) {
            $image->delete();
        }
        File::deleteDirectory(public_path('images/category/'.$id));
        return response()->json(['status' => true]);
    }
}
