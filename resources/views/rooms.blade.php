<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional: Add animation for modal */
        .fade {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
     
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Rooms List</h1>
            <!-- logout function from web.php -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addRoomModal">Add Room</button>


        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Add Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="type" class="form-label">Type:</label>
                                    <select id="type" name="type" class="form-select" required>
                                        <option value="single">Single</option>
                                        <option value="double">Double</option>
                                        <option value="suite">Suite</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="price" class="form-label">Price:</label>
                                    <input type="number" id="price" name="price" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="status" class="form-label">Status:</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="available">Available</option>
                                        <option value="booked">Booked</option>
                                        <option value="maintenance">Maintenance</option>
                                    </select>
                                </div>
                              
                                <div class="col-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">Add Room</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>

     
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
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
                          
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomModal"
                                        data-id="{{ $room->id }}" data-room_number="{{ $room->room_number }}"
                                        data-type="{{ $room->type }}" data-price="{{ $room->price }}"
                                        data-status="{{ $room->status }}" data-img="{{ $room->img }}">Edit</button>

                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline-block;">
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
    </div>


    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editRoomForm" action="{{ route('rooms.update', ':id') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                            <input type="hidden" id="edit-room_number" name="room_number" class="form-control" required>
                                <label for="type" class="form-label">Type:</label>
                                <select id="edit-type" name="type" class="form-select" required>
                                    <option value="single">Single</option>
                                    <option value="double">Double</option>
                                    <option value="suite">Suite</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" id="edit-price" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status:</label>
                                <select id="edit-status" name="status" class="form-select" required>
                                    <option value="available">Available</option>
                                    <option value="booked">Booked</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                           
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary">Update Room</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
     
        var editRoomModal = document.getElementById('editRoomModal');
        editRoomModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var roomId = button.getAttribute('data-id');
            var roomNumber = button.getAttribute('data-room_number');
            var roomType = button.getAttribute('data-type');
            var roomPrice = button.getAttribute('data-price');
            var roomStatus = button.getAttribute('data-status');
            var roomImg = button.getAttribute('data-img');

            var formAction = "{{ route('rooms.update', ':id') }}".replace(':id', roomId);
            var form = document.getElementById('editRoomForm');
            form.action = formAction;
            
            document.getElementById('edit-room_number').value = roomNumber
            document.getElementById('edit-type').value = roomType;
            document.getElementById('edit-price').value = roomPrice;
            document.getElementById('edit-status').value = roomStatus;
            document.getElementById('edit-img').value = roomImg;
        });
    </script>
</body>

</html>
