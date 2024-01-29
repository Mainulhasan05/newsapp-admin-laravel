<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use App\Models\SubDistricts;
use Illuminate\Http\Request;
use App\Models\Categories;
// require './vendor/autoload.php';
 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PostController extends Controller
{
    public function index(Request $request){
        
    }
    public function create(Request $request){
        $categories=Categories::select('id', 'name')->whereNull('parent_id')->get();
        return view('post.create',compact('categories'));
    }

    public function store(Request $request){

        $image = ImageManager::imagick()->read('images/example.jpg');

        $image->resize(300, 200);
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
        $subdistricts = SubDistricts::select('id','name')->where('district_id', $district_id)->get();
    }
}
