@extends('layouts.master')
@section('title')
    Categories    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h1>Categories</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Category Slug</th>
                        <th>Category Description</th>
                        <th>Category Image</th>
                        <th>Category Status</th>
                        <th>Category Created At</th>
                        <th>Category Updated At</th>
                        <th>Category Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category['name'] }}</td>
                        <td>{{ $category['slug'] }}</td>
                        <td>{{ $category['description'] }}</td>
                        <td><img src="{{ asset('storage/'.$category['image']) }}" alt="{{ $category['name'] }}" width="100px" height="100px"></td>
                        <td>{{ $category['status'] }}</td>
                        <td>{{ $category['created_at'] }}</td>
                        <td>{{ $category['updated_at'] }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category['id']) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('category.destroy', $category['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button> 
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>    
    </div>
@endsection