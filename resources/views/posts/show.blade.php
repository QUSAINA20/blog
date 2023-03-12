@extends('layouts.blog')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $post->title }}</h1>
            </div>
            <div class="card-body">
                <p>{{ $post->body }}</p>
                <p>Created at: {{ $post->created_at->format('d-m-Y H:i:s') }}</p>
                <p>Last updated: {{ $post->updated_at->format('d-m-Y H:i:s') }}</p>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" value="{{ $post->category->name }}" readonly>
                </div>
                @if ($post->getMedia('images')->count() > 0)
                    <div>
                        <img src="{{ $post->getFirstMedia('images')->getUrl() }}" alt="" style="max-width:500px;">
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('posts.edit', ['post' => $post->slug]) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('posts.destroy', ['post' => $post->slug]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
