<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all users
        $users = User::all();
        return response()->json($users);
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
     * Display the specified resource.
     *
     * @param  int  $email
     * @return \Illuminate\Http\Response
     */
    public function showByEmail($email)
    {
        // Find the user by email
        $user = User::where('email', $email)->firstOrFail();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email,' . $id,
            'role'         => 'required|in:admin,manager,receptionist,guest',
            'phone_number' => 'required',
        ]);

        $request['password'] = Hash::make($request['password']);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user
        $user->update($request->all());
        return response()->json($user, 200);
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
