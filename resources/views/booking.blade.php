<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Bookings List</h1>
        
        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

        <!-- Add Booking Button (Opens Modal) -->
        @auth
            @if(Auth::user()->role === 'guest')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                    Add Booking
                </button>
            @endif
        @endauth

        <!-- Add Booking Modal -->
        <div class="modal fade" id="addBookingModal" tabindex="-1" aria-labelledby="addBookingModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBookingModalLabel">Add Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">User Name</label>
                                <input type="text" disabled id="user_name" name="user_name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="room_number" class="form-label">Room Number</label>
                                <select id="room_number" name="room_number" class="form-select" required>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->room_number }}">{{ $room->room_number }} - {{ $room->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <input type="hidden" id="status" name="status" value="pending">
                            <button type="submit" class="btn btn-success">Add Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Bookings Table -->
        <table class="table table-striped">
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
                            <!-- Edit Booking Button (Opens Modal) -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBookingModal{{ $booking->id }}">
                                Edit
                            </button>

                            <!-- Edit Booking Modal -->
                            <div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" aria-labelledby="editBookingModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookingModalLabel{{ $booking->id }}">Edit Booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="user_id" class="form-label">User ID</label>
                                                    <input type="number" id="user_id" name="user_id" class="form-control" value="{{ $booking->user_id }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="room_number" class="form-label">Room Number</label>
                                                    <select id="room_number" name="room_number" class="form-select" required>
                                                        @foreach($rooms as $room)
                                                            <option value="{{ $room->room_number }}" {{ $booking->room->room_number == $room->room_number ? 'selected' : '' }}>
                                                                {{ $room->room_number }} - {{ $room->type }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $booking->start_date }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $booking->end_date }}" required>
                                                </div>
                                                @auth
                                                    @if(Auth::user()->role !== 'guest')
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select id="status" name="status" class="form-select" required>
                                                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                                <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                                                <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                            </select>
                                                        </div>
                                                    @endif
                                                @endauth
                                                <button type="submit" class="btn btn-success">Update Booking</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Booking Form -->
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
