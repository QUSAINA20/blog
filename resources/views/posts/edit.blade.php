@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form method="POST" action="{{ route('posts.update', ['post' => $post->slug]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            @if ($post->getMedia('images')->count() > 0)
                <div class="form-group">
                    <label for="current_image">Current Image</label>
                    <div>
                        <img src="{{ $post->getFirstMediaUrl('images', 'thumb') }}" alt="">
                    </div>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>

    </div>
@endsection

