@extends('layouts.master')

@section('title')
    Guest Post Articles
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1>Post Articles</h1>
                    <button>
                        <a href="{{ route('post.create') }}" class="btn btn-primary">Create</a>
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $article)
                            <tr>
                                <td>{{$article->category?->name}}</td>
                                <td>{{$article->sub_category?->name}}</td>
                                <td>{{ $article->title_bn }}</td>
                                
                                <td>
                                    @if($article->image)
                                        <img src="{{ asset('/images'."/" . $article->image) }}" alt="{{ $article->title_bn }}" width="100px" height="100px">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                {{-- <td>{{ $article->views }}</td> --}}
                                <td>
                                    
                                    <a href="{{ route('post.edit', ['id' => $article->id]) }}" class="btn btn-warning">Edit</a>
                                    
                                    <form action="{{ route('post.publish', ['id' => $article->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Publish</button>
                                    </form>
                                    
                                    <form action="{{ route('post.destroy', $article->id) }}" method="POST">
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
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
                
                
            </div>
            <div class="text-center">
                
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: '#news_description'
        });
    </script>
    <style>
        
.pagination {
    display: flex;
    justify-content: center;
}

.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-link {
    color: #007bff;
}
svg{
    display: none;
}

    </style>
    <br><br>
    <div class="pagination">
        {{-- {{ $posts->links() }} --}}
    </div>
    <br><br>
@endsection
