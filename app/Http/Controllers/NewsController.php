<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Categories;

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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for an image file
            'views' => 'integer',
            'og_image' => 'nullable|max:255',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable',
            'slug' => ['required', 'max:255', 'unique:news'],
        ]);

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create the news article
        News::create($validatedData);

        // Redirect to the news index or a success page
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
        return redirect('/news');
    }

    public function destroy($id)
    {
        // Delete a specific news article
        $news = News::find($id);
        $news->delete();

        // Redirect to the news index or a success page
        return redirect('/news');
    }
}
