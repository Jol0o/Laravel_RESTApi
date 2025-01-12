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
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

        public function register(Request $request)
    {
        $request->validate([
            'name'         => 'required|unique:users',
            'email'        => 'required|unique:users|email',
            'password'     => 'required|min:6',
            'phone_number' => 'nullable',
        ]);
    
        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => 'guest',
            'phone_number' => $request->phone_number,
        ]);
    
        Auth::login($user);
    
        if (Auth::user()->role === 'guest') {
            return redirect()->route('home');
        } else if (Auth::user()->role === 'admin') {
            return redirect()->route('rooms.view');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Get the currently authenticated user...
            $user = Auth::user();
    
            // Generate a new token for the user...
            $tokenResult = $user->createToken('Token Name');
            $token = $tokenResult->plainTextToken;
    
            if ($user->role === 'guest') {
                return redirect()->route('home')->with('token', $token);
            } else if ($user->role === 'admin') {
                return redirect()->route('rooms')->with('token', $token);
            }
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
}