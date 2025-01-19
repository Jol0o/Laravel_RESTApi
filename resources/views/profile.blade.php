@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Profile</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ $user->name }}" required autofocus>
            @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input id="phone_number" type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}">
            @error('phone_number')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" autocomplete="new-password">
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="password-confirm" class="form-label">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>

        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
        </div>
    </form>
</div>
@endsection
