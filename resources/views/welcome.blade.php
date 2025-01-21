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

    .choose-us{
      padding: 30px;
    }
    .card1, .card2, .card3{
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    
    .explore {
    position: relative;
    background-image: url('{{ asset('images/explore.png') }}');
    background-size: cover;
    background-position: center;
    height: 100%;
    padding: 40px;
    color: white; 
    z-index: 1;
    }

    .explore::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: -1;
    }

    .explore .lorem{
      font-size: 24px;
      font-weight: 300;
    }

    .line{
      border-top: 2px solid #808080;
      width: 80% !important;
      display: flex;
      margin: auto;
      margin-top: 50px;
      margin-bottom: 50px;
    }

    .special-card{
      background-color: #F2F2F2 !important;
      padding: 0;
    }

    .special-card img{
      border-radius: 20px;
    }

    .special-offer{
      margin: 50px;
    }

    

    footer {
      background-color: #000; 
      color: #fff;
      padding: 40px 20px;
    }

    .footer-section {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap; 
      gap: 20px; 
    }

    .footer-column {
      flex: 1;
      min-width: 150px;
    }

    .footer-column h4 {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .footer-column ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-column ul li {
      margin-bottom: 10px;
    }

    .footer-column ul li a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s;
    }

    .footer-column ul li a:hover {
      color: #00bcd4;
    }

    .social-icons {
      display: flex;
      gap: 15px;
      margin-top: 15px;
    }

    .social-icons a {
      color: #fff;
      font-size: 20px;
      transition: color 0.3s;
    }

    .social-icons a:hover {
      color: #00bcd4; 
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
            <img src="{{ asset('images/c1.png') }}" alt="Example Image" class="img-fluid">
            <h5 class="text-center fw-bold">Competitive Prices</h5>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/c2.png') }}" alt="Example Image"  class="img-fluid">
            <h5 class="text-center fw-bold">Secure Booking</h5>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <img src="{{ asset('images/c3.png') }}" alt="Example Image"  class="img-fluid">
            <h5 class="text-center fw-bold">Seamless Experience</h5>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="explore mt-4 mb-4">
        <h1 class="text-center text-white">EXPLORE MALDIVES</h1>

        <div class="line"></div>

        <div class="row m-0 p-0 d-flex justify-content-center mx-auto">
          <div class="col-md-4 d-flex justify-content-center align-items-center mx-auto">
            <p class="mb-0 d-flex w-100 justify-content-center align-items-center text-white lorem">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
          </div>

              <div class="col-md-2">
                <div class="card1">
                  <img src="{{ asset('images/explore1.png') }}" alt="Example Image"  class="img-fluid w-100">
                  <p>Azure Heaven</p>
                </div>
              </div>
              <div class="col-md-2">
                <div class="card2">
                  <img src="{{ asset('images/explore2.png') }}" alt="Example Image"  class="img-fluid w-100">
                  <p>Serene Sanctuary</p>
                </div>
              </div>

              <div class="col-md-2">         
                <div class="card3">
                  <img src="{{ asset('images/explore3.png') }}" alt="Example Image"  class="img-fluid w-100">
                  <p>Verdant Vista</p>
                </div>
              </div>
              </div>
          </div>
          </section>
            <section class="special-offer">
              <div class="row p-0 m-0 d-flex justify-content-center">
                <div class="col-md-8">
                  <div class="card p-0 special-card">
                    <div class="card-body p-0">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="{{ asset('images/offer.png') }}" alt="Example Image"  class="img-fluid w-100">
                        </div>
                        <div class="col-md-8 ">
                          <div class="special">
                            <h3 class="fw-bold text-center w-75 d-flex justify-content-center align-items-center mx-auto mt-4">Get special offers, and more from travelworld</h3>
                          </div>
                        </div>
                      </div>       
                    </div>
                  </div>
                </div>
              </div>
            </section>

              <footer>
                <div class="container">
                  <div class="footer-section">
                    <div class="footer-column">
                      <h4>Support</h4>
                      <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Safety Information</a></li>
                        <li><a href="#">Cancellation Options</a></li>
                      </ul>
                    </div>
                    <div class="footer-column">
                      <h4>Company</h4>
                      <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Community Blog</a></li>
                        <li><a href="#">Terms of Service</a></li>
                      </ul>
                    </div>
                    <div class="footer-column">
                      <h4>Contact</h4>
                      <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Get in Touch</a></li>
                        <li><a href="#">Partnerships</a></li>
                      </ul>
                    </div>
                    <div class="footer-column">
                      <h4>Social</h4>
                      <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </footer>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>