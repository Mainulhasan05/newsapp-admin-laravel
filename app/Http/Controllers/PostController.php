<?php

namespace App\Http\Controllers;

use App\Models\Districts;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Subdistricts;
use App\Models\Post;
// require './vendor/autoload.php';
 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PostController extends Controller
{
    public function index(Request $request){
        $posts=Post::with('category', 'sub_category', 'district', 'sub_district')->get();
        return view('post.index',compact('posts'));
        // return response()->json($posts);
    }
    public function create(Request $request){
        $categories=Categories::select('id', 'name')->whereNull('parent_id')->get();
        $districts=Districts::select('id', 'district_bn')->get();
        return view('post.create',compact('categories', 'districts'));
    }

    public function store(Request $request){
        $validate=$request->validate([
            'title_bn'=>'required',
            'description_bn'=>'required',
            'category_id'=>'required',
            'district_id'=>'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $post=new Post();
        $post->title_bn=$request->title_bn;
        $post->description_bn=$request->description_bn;
        $post->description_en=$request->description_en;
        $post->category_id=$request->category_id;
        $post->sub_category_id=$request->subcategory_id;
        $post->district_id=$request->district_id;
        $post->sub_district_id=$request->subdistrict_id;
        $post->tags_bn=$request->tags_bn;
        $post->title_en=$request->title_en;
        // check image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $post->image=$name;
        }
        $post->headline=$request->has('headline')?1:0;
        $post->first_sectrion=$request->has('first_sectrion')?1:0;
        $post->first_section_thumbnail=$request->has('first_section_thumbnail')?1:0;
        // $post->user_id=auth()->user()->id;
        $post->save();
        return redirect()->back()->with('success', 'Post created successfully');


        // $image = ImageManager::imagick()->read('images/example.jpg');

        // $image->resize(300, 200);
    }

    public function resizeImage(Request $request){
        $image = ImageManager::imagick()->read($request->image_path);
        $image->resize(200, 200);
        $image->save($request->image_path);

        return response()->json(['success'=>'Image Uploaded Successfully.']);
    }

    public function getSubcategory($category_id){
        $subcategories = Categories::select('id', 'name')->where('parent_id', $category_id)->get();
        return response()->json($subcategories);
    }
    public function getSubdistricts($district_id){
        $subdistricts = Subdistricts::select('id','subdistrict_bn')->where('district_id', $district_id)->get();
        return $subdistricts;
    }

    public function edit(Request $request, $id){
        $post=Post::find($id);
        $categories=Categories::select('id', 'name')->whereNull('parent_id')->get();
        $districts=Districts::select('id', 'district_bn')->get();
        return view('post.edit',compact('post', 'categories', 'districts'));
    }

    public function update(Request $request, $id){
        $validate=$request->validate([
            'title_bn'=>'required',
            'description_bn'=>'required',
            'category_id'=>'required',
            'district_id'=>'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $post=Post::find($id);
        $post->title_bn=$request->title_bn;
        $post->description_bn=$request->description_bn;
        $post->description_en=$request->description_en;
        $post->category_id=$request->category_id;
        $post->sub_category_id=$request->subcategory_id;
        $post->district_id=$request->district_id;
        $post->sub_district_id=$request->subdistrict_id;
        $post->tags_bn=$request->tags_bn;
        $post->title_en=$request->title_en;
        // check image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image = ImageManager::imagick()->read($image);
            $image=$image->resize(200, 200);
            $destinationPath = public_path('/images');
            $image->save($destinationPath, $name);
            $post->image=$name;          
        }
        $post->headline=$request->has('headline')?1:0;
        $post->first_sectrion=$request->has('first_sectrion')?1:0;
        $post->first_section_thumbnail=$request->has('first_section_thumbnail')?1:0;
        // $post->user_id=auth()->user()->id;
        $post->save();
        return redirect()->back()->with('success', 'Post updated successfully');
    }

    public function destroy(Request $request, $id){
        $post=Post::find($id);
        $post->delete();
        // delete the image
        $image_path = public_path().'/images/'.$post->image;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        return redirect()->back()->with('success', 'Post deleted successfully');
    }
}
