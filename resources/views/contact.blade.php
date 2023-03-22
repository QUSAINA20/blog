@extends('layouts.blog')
@section('content')
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required
                readonly>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}"
                required readonly>
        </div>
        <div class="form-group">
            <label for="message" class="form-label">Message</label>
            <textarea name="content" id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
