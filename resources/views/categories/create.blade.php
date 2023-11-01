@extends('layouts.master')
@section('title')
    Add Category
@endsection

@section('content')
    <div class="container">
        <h1>Add Category</h1>
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" name="slug" class="form-control" id="slug">
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>

            <div class="form-group">
                <label for="og_title">Open Graph Title:</label>
                <input type="text" name="og_title" class="form-control" id="og_title">
            </div>

            <div class="form-group">
                <label for="og_description">Open Graph Description:</label>
                <textarea name="og_description" class="form-control" id="og_description"></textarea>
            </div>

            <div class="form-group">
                <label for="og_image">Open Graph Image:</label>
                <input type="file" name="og_image" class="form-control-file" id="og_image">
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Category:</label>
                <select name="parent_id" class="form-control" id="parent_id">
                    <option value="">Select Parent Category</option>
                    {{-- You can dynamically populate the options here --}}
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection
