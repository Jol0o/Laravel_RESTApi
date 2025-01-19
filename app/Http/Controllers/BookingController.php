<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Import the Booking model
use App\Models\Room;

class BookingController extends Controller
{

    public function booking()
    {
        $bookings = Booking::with('user', 'room')->get();
        $rooms = Room::where('status', 'available')->get(); // Fetch all rooms
        return view('booking', compact('bookings', 'rooms'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all bookings with related user and room data
        $bookings = Booking::with('user', 'room')->get();
        return response()->json($bookings);
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
            'user_id'     => 'required|exists:users,id',
            'room_number' => 'required|exists:rooms,room_number',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'status'      => 'required|in:pending,confirmed,checked_in,checked_out,cancelled'
        ]);

        // Fetch the room ID based on the room number
        $room = Room::where('room_number', $request->room_number)->firstOrFail();

        // Create a new booking
        $booking = Booking::create([
            'user_id'    => $request->user_id,
            'room_id'    => $room->id,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'status'     => $request->status,
        ]);

        $room->update(['status' => 'booked']);

        return redirect()->route('bookings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);
        return response()->json($booking);
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
            'user_id'    => 'exists:users,id',
            'room_number' => 'exists:rooms,room_number',
            'start_date' => 'date',
            'end_date'   => 'date|after_or_equal:start_date',
            'status'     => 'required|in:pending,confirmed,checked_in,checked_out,cancelled'
        ]);
    
        // Find the booking by ID
        $booking = Booking::findOrFail($id);
    
        // Set the previous room to available
        $previousRoom = Room::findOrFail($booking->room_id);
        $previousRoom->update(['status' => 'available']);
    
        // Fetch the new room ID based on the room number
        if ($request->has('room_number')) {
            $newRoom = Room::where('room_number', $request->room_number)->firstOrFail();
            $request->merge(['room_id' => $newRoom->id]);
        }
    
        // Update the booking
        $booking->update($request->all());
    
        // Set the new room to booked
        if (isset($newRoom)) {
            $newRoom->update(['status' => 'booked']);
        }
    
        return redirect()->route('bookings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);
    
        // Set the room to available
        $room = Room::findOrFail($booking->room_id);
        $room->update(['status' => 'available']);
    
        // Delete the booking
        $booking->delete();
    
        return redirect()->route('bookings');
    }
}

