<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Room Booking System</title>
</head>

<body>
    <nav>
        <div>
            <a href="#">Room Booking</a>
            <div>
                <ul>

                    <!-- // Check if the 'login' route is defined -->
                    @if (Route::has('login'))
                        // Check if the user is authenticated
                        @auth
                            <li>
                                <!--  to the user's bookings page -->
                                <a href="{{ url('/bookings') }}">My Bookings</a>
                            </li>
                            <li>
                                <!--  to the user's profile page -->
                                <a href="{{ url('/profile') }}">Profile</a>
                            </li>
                        @else
                            <li>
                                <!--  to the login page -->
                                <a href="{{ route('login') }}">Log in</a>
                            </li>
                            <!-- Check if the 'register' route is defined -->
                            @if (Route::has('register'))
                                <li>
                                    <!--  to the registration page -->
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div>
        <div>
            <div>
                <div>
                    <h1>Welcome to Room Booking System</h1>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div>
            <p>&copy; {{ date('Y') }} Room Booking System. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>