@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container mt-5">
    <h2>User Management</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('user.management.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
