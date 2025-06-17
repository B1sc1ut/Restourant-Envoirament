@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="text-center mb-4">{{ __('login.login') }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">{{ __('login.email') }}</label>
            <input type="email" name="email" class="form-control" placeholder="{{ __('login.enter') }}" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('login.password') }}</label>
            <input type="password" name="password" class="form-control" placeholder="{{ __('login.password') }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">{{ __('login.login') }}</button>
    </form>
    
    <br>
    <a href="{{ route('google.login') }}" class="btn btn-danger w-100">{{ __('login.google') }}</a>
</div>
@endsection
