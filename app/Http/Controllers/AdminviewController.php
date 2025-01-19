<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Auth;

class AdminviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.view')->with('token', $token);
        } else {
            return redirect()->route('/');
        }
    }
}
