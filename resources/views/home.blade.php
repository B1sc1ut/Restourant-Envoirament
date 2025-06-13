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

  </div>
@endsection
