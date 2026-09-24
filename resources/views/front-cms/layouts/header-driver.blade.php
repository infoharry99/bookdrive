
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
        <link rel="stylesheet" href="{{url('frontendnew/css/bootstrap.min.css')}}">
        <!-- Style -->
        <link rel="stylesheet" href="{{url('frontendnew/css/style.css')}}">
        <!-- <link rel="stylesheet" href="{{url('frontendnew/css/responsive.css')}}"> -->
       
        <link href="{{url('frontendnew/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{url('frontendnew/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <!-- Favicon -->
        <link rel="icon" href="{{url('frontendnew/img/favicon.png')}}" type="image/x-icon">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <title>TRUST PILOT - Driving School</title>
    </head>
    <body>
       <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> -->
    <!-- Spinner End -->


  

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="{{('/')}}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <!-- <h2 class="m-0"><i class="fa fa-car text-primary me-2"></i>Drivin</h2> -->
             <img src="{{url('frontendnew/img/logo.png')}}" width="150px" alt="">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a  class=" nav-item nav-link {{ Request::is('index') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                <a  class=" nav-item nav-link {{ Request::is('tp-about') ? 'active' : '' }}" href="{{ url('/tp-about') }}">About</a>
                <a  class=" nav-item nav-link {{ Request::is('tp-course') ? 'active' : '' }}" href="{{ url('/tp-course') }}">Courses</a>
                <!-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="feature.html" class="dropdown-item">Features</a>
                        <a href="appointment.html" class="dropdown-item">Appointment</a>
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div> -->
                <a class=" nav-item nav-link {{ Request::is('tp-contact') ? 'active' : '' }}" href="{{ url('/tp-contact') }}">Contact</a>

            </div>
            <button class="btn btn-primary  px-lg-3 loginn" data-toggle="modal" onclick="openLogin();" data-target="#loginPopup">Login</button>
            <a href="{{ url('/') }}" class="btn btn-primary  py-4 px-lg-3  d-lg-block"><i class="fa fa-arrow-left ms-3"> Go Back</i></a>
        </div>
    </nav>
    <!-- Navbar End -->
