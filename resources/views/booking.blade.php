<!DOCTYPE html>
<html>

<head>
    <title>Bookings List</title>
</head>

<body>
    <div>
        <div>
            <h1>Bookings List</h1>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>

        <!-- Add Booking Form -->
        @auth
            @if(Auth::user()->role === 'guest')
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    <div>
                        <label for="user_name">User Name:</label>
                        <input type="text" disabled id="user_name" name="user_name" value="{{ Auth::user()->name }}">
                    </div>
                    <div>
                        <label for="room_number">Room Number:</label>
                        <select id="room_number" name="room_number" required>
                            @foreach($rooms as $room)
                                <option value="{{ $room->room_number }}">{{ $room->room_number }} - {{ $room->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div>
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <input type="hidden" id="status" name="status" value="pending">
                    <button type="submit">Add Booking</button>
                </form>
            @endif
        @endauth

        <hr>

        <!-- Bookings Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Room ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user_id }}</td>
                        <td>{{ $booking->room_id }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <!-- Edit Booking Form -->
                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="user_id">User ID:</label>
                                    <input type="number" id="user_id" name="user_id" value="{{ $booking->user_id }}" required>
                                </div>
                                <div>
                                    <label for="room_number">Room Number:</label>
                                    <select id="room_number" name="room_number" required>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->room_number }}" {{ $booking->room->room_number == $room->room_number ? 'selected' : '' }}>
                                                {{ $room->room_number }} - {{ $room->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" value="{{ $booking->start_date }}" required>
                                </div>
                                <div>
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" value="{{ $booking->end_date }}" required>
                                </div>
                                @auth
                                    @if(Auth::user()->role === 'guest')
                                        <input type="hidden" id="status" name="status" value="{{ $booking->status }}">
                                    @else
                                        <select id="status" name="status" required>
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                            <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    @endif
                                @endauth
                                <button type="submit">Update</button>
                            </form>

                            <!-- Delete Booking Form -->
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').setAttribute('min', today);

            document.getElementById('start_date').addEventListener('change', function () {
                var startDate = this.value;
                document.getElementById('end_date').setAttribute('min', startDate);
            });
        });
    </script>
</body>

</html>