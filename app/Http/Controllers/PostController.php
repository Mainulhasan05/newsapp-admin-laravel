<?php

namespace App\Http\Controllers;

use App\Models\Districts;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Subdistricts;
use App\Models\Post;

use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('category', 'sub_category', 'district', 'sub_district')->get();
        return view('post.index', compact('posts'));
    }

    public function guest(Request $request)
    {
        $posts = Post::with('category', 'sub_category', 'district', 'sub_district')
            ->where('is_guest', true)
            ->where('is_published', false)
            ->get();

        return view('post.guest', compact('posts'));
    }

    public function publish($id)
    {

        $post = Post::findOrFail($id);

        $post->is_published = 1;
        $post->save();

        // Redirect back or wherever appropriate
        // return redirect()->back()->with('success', 'Post published successfully.');
        // redirect to post.guest
        return redirect()->route('post.guest')->with('success', 'Post published successfully.');
    }
    public function create(Request $request)
    {
        $categories = Categories::select('id', 'name')->whereNull('parent_id')->get();
        $districts = Districts::select('id', 'district_bn')->get();
        return view('post.create', compact('categories', 'districts'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title_bn' => 'required',
            'description_bn' => 'required',
            'category_id' => 'required',
        ]);
        $post = new Post();
        $post->slug =  Str::slug($request->input('title_bn'));
        $post->title_bn = $request->title_bn;
        $post->description_bn = $request->description_bn;
        $post->description_en = $request->description_en;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->subcategory_id;
        $post->district_id = $request->district_id;
        $post->sub_district_id = $request->subdistrict_id;
        $post->tags_bn = $request->tags_bn;
        $post->title_en = $request->title_en;
        $post->user_id = auth()->user()->id;

        // check image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $post->image = $name;
        }
        $post->headline = $request->has('headline') ? 1 : 0;
        $post->first_sectrion = $request->has('first_sectrion') ? 1 : 0;
        $post->first_section_thumbnail = $request->has('first_section_thumbnail') ? 1 : 0;
        $post->big_thumbnail = $request->has('big_thumbnail') ? 1 : 0;
        // $post->user_id=auth()->user()->id;
        $post->save();
        return redirect()->back()->with('success', 'Post created successfully');
    }

    public function resizeImage(Request $request)
    {
        $image = ImageManager::imagick()->read($request->image_path);
        $image->resize(200, 200);
        $image->save($request->image_path);

        return response()->json(['success' => 'Image Uploaded Successfully.']);
    }

    public function getSubcategory($category_id)
    {
        $subcategories = Categories::select('id', 'name')->where('parent_id', $category_id)->get();
        return response()->json($subcategories);
    }
    public function getSubdistricts($district_id)
    {
        $subdistricts = Subdistricts::select('id', 'subdistrict_bn')->where('district_id', $district_id)->get();
        return $subdistricts;
    }

    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        $categories = Categories::select('id', 'name')->whereNull('parent_id')->get();
        $districts = Districts::select('id', 'district_bn')->get();
        $subcategories = Categories::select('id', 'name')->where('parent_id', $post->category_id)->get();
        $subdistricts = Subdistricts::select('id', 'subdistrict_bn')->where('district_id', $post->district_id)->get();
        return view('post.edit', compact('post', 'categories', 'districts', 'subcategories', 'subdistricts'));
        // return response()->json($post);
    }

    public function update(Request $request, $id)
    {


        $post = Post::find($id);

        $post->title_bn = $request->title_bn;
        $post->slug = Str::slug($request->title_bn);
        $post->description_bn = $request->description_bn;
        $post->description_en = $request->description_en;
        $post->category_id = $request->category_id;
        $post->sub_category_id = $request->subcategory_id;
        $post->district_id = $request->district_id;
        $post->sub_district_id = $request->subdistrict_id;
        $post->tags_bn = $request->tags_bn;
        $post->title_en = $request->title_en;

        // check image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image = ImageManager::imagick()->read($image);
            $image = $image->resize(200, 200);
            $destinationPath = public_path('/images');
            $image->save($destinationPath, $name);
            $post->image = $name;
        }

        $post->headline = $request->has('headline') ? 1 : 0;
        $post->first_sectrion = $request->has('first_sectrion') ? 1 : 0;
        $post->first_section_thumbnail = $request->has('first_section_thumbnail') ? 1 : 0;
        $post->big_thumbnail = $request->has('big_thumbnail') ? 1 : 0;

        $post->user_id = auth()->user()->id;

        $post->save(); // Save changes to the database

        return redirect()->back()->with('success', 'Post updated successfully');
    }


    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        // delete the image
        $image_path = public_path() . '/images/' . $post->image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        return redirect()->back()->with('success', 'Post deleted successfully');
    }
}
