<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <title>Room Booking System</title>
</head>

<style>

    *{
      font-family: "Inter", serif;
      font-optical-sizing: auto;
      font-weight: <weight>;
      font-style: normal;
    }
    .front {
        background-image: url('{{ asset('images/front.png') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
    }

    .navbar{
      padding: 20px;
      background-color: #fff;
    }

    .navbar a{
      color: #000;
      font-weight: 500;
    }

  
    .front-text h1 {
    font-size: clamp(30px, 5vw, 60px); 
    color: #008EC4;
    font-weight: 600;
    }

    .front-text p {
        font-size: clamp(16px, 3vw, 30px);

    }

    .card{
      border-radius: 40px;
      padding: 20px 30px;
    }

    .card a{
      background-color:#008EC4;
      padding: 16px 24px;
      color: #fff;
      font-size: 24px;
      text-decoration: none;
      border-radius: 10px;
    }
    .choose-us img{
      width: 100px;
      height: 100px;
      margin: 20px;

    }

    
</style>



<body> 

    <section class="front">
    <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <!-- Logo on the left -->
      <a class="navbar-brand" href="#">
        <img src="your-logo-url.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
        YourLogo
      </a>

      <!-- Navbar links on the right -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Destinations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="front-text d-flex justify-content-center align-items-center flex-column" style="height: 80vh;">
    <div class="card d-flex align-items-center">
      <div class="card-body">
        <h1>Good Morning!</h1>
      <p>Explore beautiful places in the world with Acenda </p>
      <a href="/login">Login</a>
    </h1>
      </div>
    </div>
    
  </div>
    </section>

    <section class="choose-us mt-4">
      <h2 class="text-center fw-bold">WHY CHOOSE US?</h2>
      <div class="container mt-4">
        <div class="row">
          <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/c1.png') }}" alt="Example Image">
            <h5 class="text-center fw-bold">Competitive Prices</h5>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/c2.png') }}" alt="Example Image">
            <h5 class="text-center fw-bold">Secure Booking</h5>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/c3.png') }}" alt="Example Image">
            <h5 class="text-center fw-bold">Seamless Experience</h5>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
      </div>
    </section>



</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>