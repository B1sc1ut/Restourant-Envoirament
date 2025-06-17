@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Add New User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.management.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="user">User</option>
                <option value="waiter">Waiter</option>
                <option value="chef">Chef</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">Create User</button>
    </form>
</div>
@endsection
