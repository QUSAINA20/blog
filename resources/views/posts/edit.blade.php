@extends('layouts.blog')

@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Post') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('posts.update', ['post' => $post->slug]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required value="{{ old('title', $post->title) }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="body">{{ __('Body') }}</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">{{ __('Category') }}</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="" disabled selected>{{ __('Select category') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}</label>
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tags">{{ __('Tags') }}</label>
                                    <select name="tags[]" id="tags" class="form-control @error('tags') is-invalid @enderror" multiple>
                                        <option value="" disabled selected>{{ __('Select tags') }}</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->name }}" {{ $post->tags->contains($tag) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if ($post->getMedia('images')->count() > 0)
                                <div class="form-group">
                                    <label for="current_image">Current Image</label>
                                    <div>
                                        <img src="{{ $post->getFirstMediaUrl('images', 'thumb') }}" alt="" class="img-fluid">
                                    </div>
                                </div>

                                @endif
                                <button type="submit" class="btn btn-primary">{{ __('Update Post') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
