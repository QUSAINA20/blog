@extends('layouts.app')

@section('content')
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <form action="{{ route('posts.index') }}" method="get">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control rounded-0 border-end-0" placeholder="Search for posts" value="{{ $query ?? '' }}">
                        <select name="category" class="form-control rounded-0 border-end-0">
                            <option value="">All categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" {{ $categorySlug == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary rounded-0">
                                <i class="fas fa-search"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        @if ($post->getFirstMedia('images'))
                        <img src="{{ $post->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $post->title }}" class="card-img-top">
                    @else
                    <img class="card-img-top" src="https://via.placeholder.com/286x180.png?text=No+Image+Available" alt="Card image cap">
                    @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->excerpt }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p>No posts found.</p>
                </div>
            @endforelse
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                {{ $posts->appends(['query' => $query, 'category' => $categorySlug])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection
