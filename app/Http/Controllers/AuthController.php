<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        // just returning auth view
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        // logout and redirect back to login page
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

        public function register(Request $request)
    {
        // validates the request parameters
        $request->validate([
            'name'         => 'required|unique:users',
            'email'        => 'required|unique:users|email',
            'password'     => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable',
        ]);

        // creates a new user
        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => 'guest',
            'phone_number' => $request->phone_number,
        ]);

        // logs in the user
        Auth::login($user);

        // redirects the user to the profile page
        if (Auth::user()->role === 'guest') {
            return redirect()->route('profile.show');
        }
    }

    public function showLoginForm()
    {
        // disregard
        return view('auth.login');
    }
    
      public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Attempt to log the user in
        $credentials = $request->only('email', 'password');

        // Log the user in if they have already logged in and have a valid token
        if (Auth::attempt($credentials)) {
            // Get the currently authenticated user
            $user = Auth::user();
    
            // Generate a new token for the user
            $tokenResult = $user->createToken('Token Name');
            $token = $tokenResult->plainTextToken;

            // Redirect the user to the appropriate page
            if ($user->role === 'guest') {
                return redirect()->route('userview.view')->with('token', $token);
            } else if ($user->role === 'admin') {
                return redirect()->route('adminview.view')->with('token', $token);
            }
        } else {
            return redirect()->route('login.form')->with('error', 'These credentials do not match our records.');
        }
    }
}