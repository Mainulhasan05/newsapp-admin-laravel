@extends('layouts.master')

@section('title')
    Pages List
@endsection

@section('content')
    <div class="container">
        <h1>Pages List</h1>
        <a href="{{ route('pages.create') }}" class="btn btn-primary mb-2">Add Page</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('pages.destroy', $page->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pages->links() }}
    </div>
@endsection
