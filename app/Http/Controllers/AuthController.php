<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Get the currently authenticated user...
            $user = Auth::user();

            // Generate a new token for the user...
            $tokenResult = $user->createToken('Token Name');
            $token = $tokenResult->plainTextToken;

            $user = auth()->user();
            return response()->json(['status' => 'success', 'token' => $token, 'id' => $user->id], 200);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }
}