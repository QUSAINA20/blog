@extends('layouts.blog')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $post->title }}</h1>
                <h2>written by : {{ $post->user->name }}</h2>
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
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Comments:</h4>
                            @foreach($post->comments as $comment)
                                <div class="media">
                                    <img class="mr-3" src="https://via.placeholder.com/50x50" alt="User Avatar">
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                        <p>{{ $comment->body }}</p>
                                        @auth
                                            @if(auth()->user()->id === $comment->user_id)
                                                <form action="{{ route('comments.destroy', ['post' => $post->slug, 'comment' => $comment->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Add a Comment:</h4>
                            <form method="POST" action="{{ route('comments.store', ['post' => $post->slug]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea name="body" class="form-control" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
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
