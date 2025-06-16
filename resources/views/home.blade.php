@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="text-center">
    <h1 class="mb-3">Welcome to My Laravel App</h1>
    <p>This is the homepage built with Bootstrap.</p>
    <p>Current locale: {{ app()->getLocale() }}</p>
    <p>Session locale: {{ session('locale') }}</p>

    <h2>App locale: {{ app()->getLocale() }}</h2>
    <h2>Session locale: {{ session('locale') ?? 'null' }}</h2>

    <a href="{{ route('lang.switch', ['locale' => 'lv']) }}">Latviski</a> |
    <a href="{{ route('lang.switch', ['locale' => 'en']) }}">English</a>

    @auth
      <div class="alert alert-success mt-4">
        You are logged in as: <strong>{{ auth()->user()->email }}</strong><br>
        Your role is: <strong>{{ auth()->user()->role }}</strong>
      </div>
    @else
      <div class="alert alert-warning mt-4">
        You are not logged in.
       </div>
    @endauth
    @auth
      <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    @endauth


  </div>
@endsection
