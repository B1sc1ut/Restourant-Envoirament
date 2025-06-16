@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="text-center mb-4">Register</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Register</button>
    </form>

    <br>
    <a href="{{ route('google.login') }}" class="btn btn-danger w-100">Login with Google</a>
</div>
@endsection
