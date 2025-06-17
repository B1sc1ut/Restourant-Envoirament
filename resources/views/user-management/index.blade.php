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
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('user.management.edit', $user->id) }}" class="btn btn-sm btn-info">Edit Role</a>
                @endif

                {{-- Existing delete button --}}
                <form action="{{ route('user.management.delete', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
