<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Import the Room model

class RoomController extends Controller
{
    public function view()
    {
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all rooms
        $rooms = Room::all();
        return response()->json($rooms);
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
            'type'   => 'required',
            'price'  => 'required|numeric',
            'status' => 'required|in:available,booked,maintenance',
        ]);

        // Get the last room_number and increment it by 1, or default to 101
        $lastRoom = Room::orderBy('room_number', 'desc')->first();
        $roomNumber = $lastRoom ? $lastRoom->room_number + 1 : 101;


        // Create a new room
        $room = Room::create([
            'room_number' => $roomNumber,
            'type'        => $request->type,
            'price'       => $request->price,
            'status'      => $request->status,
        ]);

        return redirect()->route('rooms.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the room by ID
        $room = Room::findOrFail($id);
        return response()->json($room);
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
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'room_number' => 'required',
            'type'        => 'required',
            'price'       => 'required|numeric',
            'status'      => 'required|in:available,booked,maintenance',
        ]);

        // Find the room by ID
        $room = Room::findOrFail($id);

        // Update the room
        $room->update($validatedData);

        return redirect()->route('rooms.view');
    } catch (\Exception $e) {
        // Handle errors (e.g., database error, validation error)
        return response()->json([
            'error' => $e->getMessage()
        ], 400);
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the room by ID and delete
        Room::findOrFail($id)->delete();
        return redirect()->route('rooms.view');
    }
}