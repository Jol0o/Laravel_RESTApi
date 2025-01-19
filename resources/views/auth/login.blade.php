@extends('layouts.app')

@section('content')
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="container ">
                            <div class="row d-flex justify-content-center align-items-center mx-auto" style="height: 85vh;">
                                <div class="col-md-6">
                                <form method="POST" action="{{ route('login') }}" class="login-form">
                                @csrf
                                <h3 class="text-center mb-4 fw-bold">Member Login</h3>
                                <input id="email" type="email" placeholder="Enter your email" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                                <input id="password" placeholder="Enter your password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="btn-login col-md-12 d-flex justify-content-center flex-column mx-auto">
                                    <button type="submit" class="btn w-100">
                                        {{ __('Login') }}
                                    </button>
                                    <p>Don't have an account? <span><a class="" href="{{ route('register') }}">{{ __('Register') }}</a></span></p>
                                    
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
@endsection