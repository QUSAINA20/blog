@extends('layouts.blog')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $category->name }}</h1>
            </div>
            <div class="card-body">
                <p>Slug: {{ $category->slug }}</p>
                @if ($category->getMedia('images')->count() > 0)
                    <div>
                        <img src="{{ $category->getFirstMedia('images')->getUrl() }}" alt="" style="max-width:500px;">
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('categories.edit',['category' => $category->slug] ) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('categories.destroy',['category' => $category->slug]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-5">
            <h2>Posts in this Category:</h2>
            @if ($category->posts->count() > 0)
                <ul>
                    @foreach ($category->posts as $post)
                        <li><a href="{{ route('posts.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>No posts in this category yet.</p>
            @endif
        </div>
    </div>
@endsection
