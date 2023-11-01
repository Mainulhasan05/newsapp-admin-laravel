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
                            <th>Description</th>
                            <th>Image</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->description }}</td>
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
                                    <a href="{{ route('news.edit', $article->id) }}" class="btn btn-warning">Edit</a>
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
        </div>
    </div>
@endsection
