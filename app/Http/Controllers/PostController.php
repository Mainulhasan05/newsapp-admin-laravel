<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
class PostController extends Controller
{
    public function index(Request $request){
        
    }
    public function create(Request $request){
        $categories=Categories::select('id', 'name')->whereNull('parent_id')->get();
        return view('post.create',compact('categories'));
    }

    public function store(Request $request){

    }
}
