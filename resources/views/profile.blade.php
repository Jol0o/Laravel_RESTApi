@extends('layouts.app')

@section('content')
<div>
    <h1>Profile</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus>
            @error('name')
                <div>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ $user->email }}" required>
            @error('email')
                <div>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="phone_number">Phone Number</label>
            <input id="phone_number" type="text" name="phone_number" value="{{ $user->phone_number }}">
            @error('phone_number')
                <div>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" autocomplete="new-password">
            @error('password')
                <div>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password">
        </div>

        <div>
            <button type="submit">Update Profile</button>
        </div>
    </form>
</div>
@endsection