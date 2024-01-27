<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Categories as ModelsCategories;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view("categories.view", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // $this->validate($request, [
    //     'name' => 'required|string|max:255',
    //     'slug' => 'string|max:255',
    //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules for your image
    //     'og_title' => 'string|max:255',
    //     'og_description' => 'string',
    //     'og_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     'parent_id' => 'nullable|exists:categories,id', // Check if the parent category exists
    // ]);

    $category = new ModelsCategories();
    $category->name = $request->input('name');
    $category->slug = $request->input('slug');
    $category->og_title = $request->input('og_title');
    $category->og_description = $request->input('og_description');
    $category->parent_id = $request->input('parent_id');

    // Handle image and og_image uploads if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;
    }

    if ($request->hasFile('og_image')) {
        $ogImagePath = $request->file('og_image')->store('categories', 'public');
        $category->og_image = $ogImagePath;
    }

    $category->save();

    return redirect()->route('categories.index')->with('success', 'Category created successfully');
}


    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category=Categories::find($id);
        $categories = Categories::select('id', 'name')->whereNull('parent_id')->where('id', '!=', $id)->get();
        
        
        return view("categories.edit",compact("category","categories")); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate=$request->validate([
            'name'=>'required',            
        ]);
        $data=array();
        $data['name']=$request->input('name');
        // generate slug based on name
        $data['slug']=Str::slug($request->input('name'));
        Categories::where('id',$id)->update($data);
        return redirect()->route('categories.index')->with('success','');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the category by its ID
    $category = ModelsCategories::find($id);

    if (!$category) {
        return redirect()->route('categories.index')->with('error', 'Category not found.');
    }

    // Delete the category
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
}

}
