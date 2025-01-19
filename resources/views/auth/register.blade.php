@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center flex-column">
    <div class="row d-flex justify-content-center" style="height: 90vh;">
    <div class="col-md-6">
    <div class="login-form">
        <h3 class="text-center mb-4 fw-bold">Member Register</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                <div class="btn-login">
                    <button type="submit" class="btn w-100">
                        {{ __('Register') }}
                    </button>
                </div>
                <p class="text-center mt-2 mb-2">or</p>
                <div class="btn-login">
                    <a class="nav-link d-flex justify-content-center" href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
                
            </div>
        </form>
    </div>
                
    </div>
    </div>
</div>
@endsection
