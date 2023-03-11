<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Blog')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/spatie/laravel-medialibrary/css/app.css') }}">
    <script src="{{ asset('vendor/spatie/laravel-medialibrary/js/app.js') }}"></script>
    <style>
        /* Add custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 500;
        }
        .nav-link {
            font-size: 1.1rem;
        }
        .nav-link:hover {
            color: #007bff;
        }
        .active {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('posts.index') }}">My Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                <li class="nav-item {{ Request::is('posts/create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
                </li>
                <li class="nav-item {{ Request::is('categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item {{ Request::is('categories/create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('categories.create') }}">Create Category</a>
                </li>
                <li class="nav-item {{Request::routeIs('contact.show') ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('contact.show') }}">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container py-5">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
