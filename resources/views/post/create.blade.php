@extends('layouts.master')

@section('title')
    Create Post Article
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Create Post Article</h1>
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
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
                            <select class="form-control" name="category_id" id="categorySelect">
                                <option value="">Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">SubCategory</label>
                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                <option value="">Select Category</option>
                                
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="title">Districts</label>
                            <select class="form-control" name="district_id" id="districtSelect">
                                <option value="">Select Districts</option>
                                @foreach ($districts as $item)
                                    <option value="{{ $item->id }}">{{ $item->district_bn }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">SubDistricts</label>
                            <select class="form-control" name="subdistrict_id" id="subdistrict_id">
                                <option value="">Select Category</option>
                                
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
                    <hr>
                    <h3 class="text-center">Extra Option</h3>
                    <div class="form-group">
                        <input type="checkbox" name="headline" id="is_header" class="">
                        <label for="is_header">Is Headline</label>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="first_sectrion" id="is_featured" class="">
                        <label for="is_featured">Is First Section</label>
                    </div>

                    
                    <div class="form-group">
                        <input type="checkbox" name="first_section_thumbnail" id="is_published" class="">
                        <label for="is_published">Is First Section Thumbnail</label>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#categorySelect').on('change', function() {
            console.log('object')
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{  url('/get/subcategory/') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        console.log(data);
                         $("#subcategory_id").empty();
                             $.each(data,function(key,value){
                                 $("#subcategory_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                             });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });

    </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#districtSelect').on('change', function() {
            
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: "{{  url('/get/subdistricts/') }}/"+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        console.log(data);
                         $("#subdistrict_id").empty();
                             $.each(data,function(key,value){
                                 $("#subdistrict_id").append('<option value="'+value.id+'">'+value.subdistrict_bn+'</option>');
                             });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });

    </script>
@endsection
