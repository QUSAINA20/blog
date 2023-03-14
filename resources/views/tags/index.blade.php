@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Tags</h1>
            <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                <a href="{{ route('tags.show',['tag' => $tag->slug]) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('tags.edit', ['tag' => $tag->slug]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tags.destroy',['tag' => $tag->slug]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
