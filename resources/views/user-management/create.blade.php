@extends('layouts.app')

@section('title', 'Add New User')

@section('content')
<h1>Add New User</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('user.management.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-select" required>
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Add User</button>
    <a href="{{ route('user.management') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
