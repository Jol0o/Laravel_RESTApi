<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Import the Room model

class RoomController extends Controller
{
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
            'img'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the last room_number and increment it by 1, or default to 101
        $lastRoom = Room::orderBy('room_number', 'desc')->first();
        $roomNumber = $lastRoom ? $lastRoom->room_number + 1 : 101;

        // Handle the image upload
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
        }

        // Create a new room
        $room = Room::create([
            'room_number' => $roomNumber,
            'type'        => $request->type,
            'price'       => $request->price,
            'status'      => $request->status,
            'img'         => $imageName,
        ]);

        return response()->json($room, 201);
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
        // Validate the request data
        $request->validate([
            'room_number' => 'required',
            'type'        => 'required',
            'price'       => 'required|numeric',
            'status'      => 'required|in:available,booked,maintenance',
        ]);

        // Find the room by ID
        $room = Room::findOrFail($id);

        // Update the room
        $room->update($request->all());
        return response()->json($room, 200);
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
        return response()->json(null, 204);
    }
}
