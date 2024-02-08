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
                        <th>Parent Category</th>
                        <th>Category Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        
                        <td>{{ $category->parent_id }}</td>
                        
                        
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
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Parent Category</th>
                        <th>Category Action</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>    
    </div>
    {{ $categories->links() }}
@endsection