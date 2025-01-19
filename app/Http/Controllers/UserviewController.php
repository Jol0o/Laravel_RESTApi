<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
         
        dd($user->role);
        if ($user->role === 'guest') {
            return view('userview', compact("user"));
        } else {
            return redirect()->route('/');
        }
    }
}