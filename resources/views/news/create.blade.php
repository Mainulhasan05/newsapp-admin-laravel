@extends('layouts.master')

@section('title')
    Create News Article
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create News Article</h1>
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_slug">Category</label>
                        <select name="category_slug" id="category_slug" class="form-control" required>
                            <option value="" disabled selected>Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="news_description" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="views">Views</label>
                        <input type="number" name="views" id="views" class="form-control" value="0">
                    </div>

                    <div class="form-group">
                        <label for="og_image">OG Image</label>
                        <input type="text" name="og_image" id="og_image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="og_title">OG Title</label>
                        <input type text" name="og_title" id="og_title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="og_description">OG Description</label>
                        <textarea name="og_description" id="og_description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#news_description', // Update the selector to match the ID of your description textarea
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
@endsection
