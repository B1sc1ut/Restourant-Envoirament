@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<h1>User Management</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('user.management.create') }}" class="btn btn-primary mb-3">Add New User</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <form action="{{ route('users.roles.update') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <select name="role" class="form-select" style="display:inline; width:auto;">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="waiter" {{ $user->role == 'waiter' ? 'selected' : '' }}>Waiter</option>
                        <option value="chef" {{ $user->role == 'chef' ? 'selected' : '' }}>Chef</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
                <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
