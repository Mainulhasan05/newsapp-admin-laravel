@extends('layouts.master')

@section('title')
    Create Post Article
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Post Article</h1>
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Title Bangla</label>
                            <input type="text" name="title_bn" id="title" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Title English</label>
                            <input type="text" name="title_en" id="title" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">SubCategory</label>
                            <select class="form-control" name="sub_category_id" id="">
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control -file">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Tags Bangla (Comma Separated)</label>
                            <input type="text" name="tags_bn" id="title" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Tags English (Comma Separated)</label>
                            <input type="text" name="tags_en" id="title" class="form-control" required>
                        </div>
                    </div>

                    {{-- TinyMCE code --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Description Bangla</h5>
                            <!-- TinyMCE Editor -->
                            <textarea name="description_bn" class="tinymce-editor">
                          </textarea><!-- End TinyMCE Editor -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Description English (Optional)</h5>
                            <!-- TinyMCE Editor -->
                            <textarea name="description_en" class="tinymce-editor">
                          </textarea><!-- End TinyMCE Editor -->
                        </div>
                    </div>

                    {{-- create two checkbox is_header and is_featured --}}

                    <div class="form-group">
                        <input type="checkbox" name="is_header" id="is_header" class="">
                        <label for="is_header">Is Header</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="is_featured" id="is_featured" class="">
                        <label for="is_featured">Is Featured</label>
                    </div>

                    {{-- is_published --}}
                    <div class="form-group">
                        <input type="checkbox" name="is_published" id="is_published" class="">
                        <label for="is_published">Is Published</label>
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
                        <input type="text" name="og_title" id="og_title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="og_description">OG Description</label>
                        <textarea name="og_description" id="og_description" class="form-control" rows="4"></textarea>
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
