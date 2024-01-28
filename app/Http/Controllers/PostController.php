<?php

namespace App\Http\Controllers;

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
}
