@extends('layouts.app')

@section('title', 'Edit User Role')

@section('content')
<h1>Edit User Role</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('user.management.update', $user->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="email" class="form-label">Email (cannot be changed)</label>
        <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-select" required>
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Role</button>
    <a href="{{ route('user.management') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
