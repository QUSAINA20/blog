@extends('layouts.blog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Categories</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts Numbers</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->posts()->count() }}</td>
                            <td>
                                <a href="{{ route('categories.show',['category' => $category->slug]) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('categories.edit', ['category' => $category->slug]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy',['category' => $category->slug]) }}" method="POST" style="display: inline-block;">
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
