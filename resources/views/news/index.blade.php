@extends('layouts.master')

@section('title')
    News Articles
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>News Articles</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            
                            <th>Image</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                
                                <td>
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" width="100px" height="100px">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $article->views }}</td>
                                <td>
                                    <a href="{{ route('news.show', $article->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('news.edit', ['id' => $article->id]) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('news.destroy', $article->id) }}" method="POST">
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
        {{ $news->links() }}
    </div>
    <br><br>
@endsection
