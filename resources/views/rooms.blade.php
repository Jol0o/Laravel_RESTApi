<!DOCTYPE html>
<html>

<head>
    <title>Rooms List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div clas="d-flex">
            <h1>Rooms List</h1>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>


        <!-- Add Room Form -->
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="suite">Suite</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="available">Available</option>
                    <option value="booked">Booked</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" class="form-control" id="img" name="img" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>

        <hr>

        <!-- Rooms Table -->
        <table class="table table-bordered">
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
                            <form action="{{ route('rooms.update', $room->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="type">Type:</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="single" {{ $room->type == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="double" {{ $room->type == 'double' ? 'selected' : '' }}>Double</option>
                                        <option value="suite" {{ $room->type == 'suite' ? 'selected' : '' }}>Suite</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ $room->price }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>
                                            Available</option>
                                        <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked
                                        </option>
                                        <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>
                                            Maintenance</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </form>

                            <!-- Delete Room Form -->
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
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