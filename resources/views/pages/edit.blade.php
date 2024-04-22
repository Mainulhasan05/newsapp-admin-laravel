@extends('layouts.master')

@section('title')
    Edit Page - {{ $page->title }}
@endsection

@section('content')
    <div class="container">
        <h1>Edit Page - {{ $page->title }}</h1>
        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $page->title }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $page->slug }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <textarea name="description" class="tinymce-editor">
                        {{ $page->description }}
                  </textarea>
                </div>
            </div>
            {{-- <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4">{{ $page->description }}</textarea>
            </div> --}}
            <button type="submit" class="btn btn-primary">Update Page</button>
        </form>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#news_description', // Update the selector to match the ID of your description textarea
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endsection
