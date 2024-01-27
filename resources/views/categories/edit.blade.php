@extends('layouts.master')
@section('title')
    Edit Category
@endsection

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ route('category.update',$category->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input value="{{$category->name}}" type="text" name="name" class="form-control" id="name" required>
            </div>


            <div class="form-group">
                <label for="og_title">Open Graph Title:</label>
                <input value="{{$category->og_title}}" type="text" name="og_title" class="form-control" id="og_title">
            </div>

            <div class="form-group">
                <label for="og_description">Open Graph Description:</label>
                <textarea value="{{$category->og_description}}" name="og_description" class="form-control" id="og_description"></textarea>
            </div>


            <div class="form-group">
                <label for="parent_id">Parent Category:</label>
                <select name="parent_id" class="form-control" id="parent_id">
                    <option value="">Select Parent Category</option>
                    @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Edit Category</button>
        </form>
    </div>
@endsection
