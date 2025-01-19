
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
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a href="{{ url('/bookings') }}">My Bookings</a>
                            </li>
                            <li>
                                <a href="{{ url('/profile') }}">Profile</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
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