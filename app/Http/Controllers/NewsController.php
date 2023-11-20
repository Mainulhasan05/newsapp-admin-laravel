<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class NewsController extends Controller
{
    public function index()
    {
        // get news in descending order
        $news = News::latest()->paginate(3);
        // return $news;
        return view('news.index', compact('news'));
    }

    public function create()
    {
        // Retrieve a list of categories for category selection
        $categories = Categories::all();

        // Show the create news article form with the list of categories
        return view('news.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        
        // $this->validate($request, [
        //     'category_id' => 'required|exists:categories,id',
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable', // You can keep it as 'nullable' if you're allowing HTML
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'og_title' => 'string|max:255',
        //     'og_description' => 'string',
        //     'og_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'slug' => ['required', 'string', 'max:255', 'unique:news'],
        // ]);

        $news = new News();
        $news->category_slug = $request->input('category_slug');
        $news->title = $request->input('title');
        $news->description = $request->input('description');
        $news->og_title = $request->input('og_title');
        $news->og_description = $request->input('og_description');

        // $news->slug = $request->input('slug');
        // generate slug from title
        $news->slug=  Str::slug($request->input('title'));
        // store the value of two check box, is_featured and is_published and is_featured
        $news->is_featured = $request->input('is_featured') ? true : false;
        $news->is_published = $request->input('is_published') ? true : false;
        $news->is_published = $request->input('is_header') ? true : false;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $news->image = $imagePath;
            $news->og_image = $imagePath;
        }

        

        $news->save();

        // // Redirect to the news index or a success page
        return redirect()->route('news.index')->with('success', 'News article created successfully');
    }

    public function show($id)
    {
        // Display a specific news article
        $news = News::find($id);
        return view('news.show', compact('news'));
    }

    public function edit($id)
    {
        // Show the edit form for a specific news article
        $news = News::find($id);
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        // Update a specific news article
        $news = News::find($id);
        $news->update($request->all());

        // Redirect to the news index or a success page
        return redirect()->route('news.index');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect()->route('news.index');
    }
}
