@extends('layouts.master')

@section('title')
    {{ $page->title }}
@endsection

@section('content')
    <div class="container">
        <h1>{{ $page->title }}</h1>
        <p><strong>Slug:</strong> {{ $page->slug }}</p>
        <p><strong>Description:</strong> {{ $page->description }}</p>
        @if ($page->image)
            <p><img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" style="max-width: 300px;"></p>
        @endif
    </div>
@endsection
