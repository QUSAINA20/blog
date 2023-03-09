@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                            <a href="{{ route('posts.show', ['post' => $post->slug]) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('posts.edit', ['post' => $post->slug]) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('posts.destroy', ['post' => $post->slug]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    </div>
@endsection

