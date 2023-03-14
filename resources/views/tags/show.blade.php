@extends('layouts.blog')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $tag->name }}</h1>
            </div>
            <div class="card-body">
                <p>Slug: {{ $tag->slug }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('tags.edit',['tag' => $tag->slug] ) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tags.destroy',['tag' => $tag->slug]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-5">
            <h2>Posts in this tag:</h2>
            @if ($tag->posts->count() > 0)
                <ul>
                    @foreach ($tag->posts as $post)
                        <li><a href="{{ route('posts.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>No posts in this tag yet.</p>
            @endif
        </div>
    </div>
@endsection
