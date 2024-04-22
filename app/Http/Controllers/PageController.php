<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'required|string|unique:pages,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'description' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Create new page
        $page = new Page([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);
        $page->save();

        return redirect('/pages')->with('success', 'Page created successfully!');
    }

    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        // Validate request data
        $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'required|string|unique:pages,slug,' . $page->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'description' => 'required|string',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }
            // Upload new image
            $imagePath = $request->file('image')->store('images', 'public');
            $page->image = $imagePath;
        }

        // Update the page
        $page->title = $request->input('title');
        $page->slug = $request->input('slug');
        $page->description = $request->input('description');
        $page->save();

        return redirect('/pages')->with('success', 'Page updated successfully!');
    }

    public function destroy(Page $page)
    {
        // Delete associated image if exists
        if ($page->image) {
            Storage::disk('public')->delete($page->image);
        }

        $page->delete();

        return redirect('/pages')->with('success', 'Page deleted successfully!');
    }
}
