@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        <p>Created at: {{ $post->created_at->format('d-m-Y H:i:s') }}</p>
        <p>Last updated: {{ $post->updated_at->format('d-m-Y H:i:s') }}</p>
        @if ($post->getMedia('images')->count() > 0)
                <div>
                    <img src="{{ $post->getFirstMedia('images')->getUrl() }}" alt="" width="500px">
                </div>
            @endif
        <a href="{{ route('posts.edit', ['post' => $post->slug]) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', ['post' => $post->slug]) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
        </form>
    </div>
@endsection

