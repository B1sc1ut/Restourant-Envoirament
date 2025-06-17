@extends('layouts.app')

@section('title', 'Home')

@section('content')
  <div class="text-center">
    <h1 class="mb-3">{{ __('home.title') }}</h1>
    <p>{{ __('home.p1') }}</p>
  </div>
@endsection
