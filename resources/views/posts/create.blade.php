@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Post</h1>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection

