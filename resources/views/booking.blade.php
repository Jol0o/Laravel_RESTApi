<!DOCTYPE html>
<html>

<head>
    <title>Bookings List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Bookings List</h1>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

        <!-- Add Booking Form -->
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="user_name">User Name:</label>
                <input class="form-control" type="text" disabled id="user_name" name="user_name"
                    value="{{ Auth::user()->name }}">
            </div>
            <div class="form-group">
                <label for="room_number">Room Number:</label>
                <select class="form-control" id="room_number" name="room_number" required>
                    @foreach($rooms as $room)
                        <option value="{{ $room->room_number }}">{{ $room->room_number }} - {{ $room->type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <input type="hidden" id="status" name="status" value="pending">
            <button type="submit" class="btn btn-primary">Add Booking</button>
        </form>

        <hr>

        <!-- Bookings Table -->
        <table class="table table-bordered">
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
                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="user_id">User ID:</label>
                                    <input type="number" class="form-control" id="user_id" name="user_id"
                                        value="{{ $booking->user_id }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="room_number">Room Number:</label>
                                    <select class="form-control" id="room_number" name="room_number" required>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->room_number }}" {{ $booking->room->room_number == $room->room_number ? 'selected' : '' }}>
                                                {{ $room->room_number }} - {{ $room->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        value="{{ $booking->start_date }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        value="{{ $booking->end_date }}" required>
                                </div>
                                 @auth
                                    @if(Auth::user()->role === 'guest')
                                        <input type="hidden" id="status" name="status" value="{{ $booking->status }}">
                                    @else
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                            <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    @endif
                                @endauth
                                    <button type="submit" class="btn btn-warning">Update</button>
                            </form>

                            <!-- Delete Booking Form -->
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>