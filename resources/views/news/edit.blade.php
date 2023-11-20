@extends('layouts.master')

@section('title')
    @if(isset($news))
        Edit News Article
    @else
        Create News Article
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($news))
                    <h1>Edit News Article</h1>
                    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT') {{-- Use the PUT method for updates --}}
                @else
                    <h1>Create News Article</h1>
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @endif
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ isset($news) ? $news->title : '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category_slug">Category</label>
                        <select name="category_slug" id="category_slug" class="form-control" required>
                            <option value="" disabled selected>Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ isset($news) && $news->category_slug == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="news_description" name="description">{{ isset($news) ? $news->description : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="is_header" id="is_header" {{ isset($news) && $news->is_header ? 'checked' : '' }}>
                        <label for="is_header">Is Header</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="is_featured" id="is_featured" {{ isset($news) && $news->is_featured ? 'checked' : '' }}>
                        <label for="is_featured">Is Featured</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="is_published" id="is_published" {{ isset($news) && $news->is_published ? 'checked' : '' }}>
                        <label for="is_published">Is Published</label>
                    </div>

                    <div class="form-group">
                        <label for="views">Views</label>
                        <input type="number" name="views" id="views" class="form-control" value="{{ isset($news) ? $news->views : '0' }}">
                    </div>

                    <div class="form-group">
                        <label for="og_image">OG Image</label>
                        <input type="text" name="og_image" id="og_image" class="form-control" value="{{ isset($news) ? $news->og_image : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="og_title">OG Title</label>
                        <input type="text" name="og_title" id="og_title" class="form-control" value="{{ isset($news) ? $news->og_title : '' }}">
                    </div>

                    <div class="form-group">
                        <label for="og_description">OG Description</label>
                        <textarea name="og_description" id="og_description" class="form-control" rows="4">{{ isset($news) ? $news->og_description : '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        @if(isset($news))
                            Update
                        @else
                            Create
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#news_description',
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
@endsection
