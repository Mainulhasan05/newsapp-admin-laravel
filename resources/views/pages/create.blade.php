@extends('layouts.master')

@section('title')
    Add Page
@endsection

@section('content')
    <div class="container">
        <h1>Add Page</h1>
        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div>
                <div class="form-group col-md-6">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" required>
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
                  </textarea>
                </div>
            </div>
            {{-- <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                
            </div> --}}
            <button type="submit" class="btn btn-primary">Add Page</button>
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
