<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Blog')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/spatie/laravel-medialibrary/css/app.css') }}">
    <script src="{{ asset('vendor/spatie/laravel-medialibrary/js/app.js') }}"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('posts.index') }}">My Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                <li class="nav-item {{ Request::is('posts/create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
