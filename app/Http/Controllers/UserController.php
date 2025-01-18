<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name'         => 'required|unique:users',
            'email'        => 'required|email|unique:users',
            'password'     => 'required',
            'role'         => 'required|in:admin,manager,receptionist,guest',
            'phone_number' => 'required',
        ]);

        $request['password'] = Hash::make($request['password']);

        // Create a new user
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the user by ID
        $user = User::with('bookings')->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Display the specified resource by email.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function showByEmail($email)
    {
        // Find the user by email
        $user = User::where('email', $email)->firstOrFail();
        return response()->json($user);
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'name'         => 'required|unique:users,name,' . $user->id,
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|string|min:8|confirmed',
            'phone_number' => 'nullable',
        ]);

        // Update the user
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the user by ID and delete
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}