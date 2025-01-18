<!DOCTYPE html>
<html>

<head>
    <title>Rooms List</title>
</head>

<body>
    <div>
        <div>
            <h1>Rooms List</h1>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>

        <!-- Add Room Form -->
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="type">Type:</label>
                <select id="type" name="type" required>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="suite">Suite</option>
                </select>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="available">Available</option>
                    <option value="booked">Booked</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div>
                <label for="img">Image:</label>
                <input type="file" id="img" name="img" required>
            </div>
            <button type="submit">Add Room</button>
        </form>

        <hr>

        <!-- Rooms Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room Number</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->type }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->status }}</td>
                        <td>
                            <!-- Edit Room Form -->
                            <form action="{{ route('rooms.update', $room->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="type">Type:</label>
                                    <select id="type" name="type" required>
                                        <option value="single" {{ $room->type == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="double" {{ $room->type == 'double' ? 'selected' : '' }}>Double</option>
                                        <option value="suite" {{ $room->type == 'suite' ? 'selected' : '' }}>Suite</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="price">Price:</label>
                                    <input type="number" id="price" name="price" value="{{ $room->price }}" required>
                                </div>
                                <div>
                                    <label for="status">Status:</label>
                                    <select id="status" name="status" required>
                                        <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                        <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    </select>
                                </div>
                                <button type="submit">Update</button>
                            </form>

                            <!-- Delete Room Form -->
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
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
</body>

</html>