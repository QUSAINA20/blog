@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Images</h1>
            <a href="{{ route('images.create') }}" class="btn btn-primary mb-3">Create image</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($images as $image)
                        <tr>
                            <td>{{ $image->name }}</td>
                            <td>{{ $image->slug }}</td>
                            <td>{{ $image->description }}</td>
                            <td>
                                <a href="{{ route('images.show',['image' => $image->slug]) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('images.edit', ['image' => $image->slug]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('images.destroy',['image' => $image->slug]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
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
