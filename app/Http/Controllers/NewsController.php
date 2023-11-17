<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
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
        $news->slug = $request->input('slug');

        // Handle image and og_image uploads if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $news->image = $imagePath;
        }

        if ($request->hasFile('og_image')) {
            $ogImagePath = $request->file('og_image')->store('images', 'public');
            $news->og_image = $ogImagePath;
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
