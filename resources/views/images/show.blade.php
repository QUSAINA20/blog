@extends('layouts.blog')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $image->name }}</h1>
            </div>
            <div class="card-body">
                <p>Slug: {{ $image->slug }}</p>
                <p>Description: {{ $image->description }}</p>
                @if ($image->getMedia('images')->count() > 0)
                    <div>
                        <img src="{{ $image->getFirstMedia('images')->getUrl() }}" alt="" style="max-width:500px;">
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('images.edit',['image' => $image->slug] ) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('images.destroy',['image' => $image->slug]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                </form>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h4>Comments:</h4>
                    @foreach($image->comments as $comment)
                        <div class="media">
                            <img class="mr-3" src="https://via.placeholder.com/50x50" alt="User Avatar">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                <p>{{ $comment->body }}</p>
                                @auth
                                    @if(auth()->user()->id === $comment->user_id)
                                        <form action="{{ route('image_comments.destroy', ['image' => $image->slug, 'comment' => $comment->id]) }}" method="POST">
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
                    <form method="POST" action="{{ route('image_comments.store', ['image' => $image->slug]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" readonly>
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
    </div>
@endsection
