
<!doctype html>
<html lang="en">
    
    <head>
    <meta charset="utf-8">
    <title>BookDriving</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{url('frontendnew/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('frontendnew/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('frontendnew/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{url('frontendnew/css/style.css')}}" rel="stylesheet">
    <link href="{{url('frontendnew/css/responsive.css')}}" rel="stylesheet">
    <link rel="icon" href="{{url('frontendnew/img/favicon.png')}}" type="image/x-icon">
</head>
    <body>
         <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-warning" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

     <!-- Topbar Start -->
     <div class="container-fluid topbar bg-secondary d-none d-xl-block w-100" >
        <div class="container" style="display:none;">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-6 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <img src="{{url('frontendnew/img/icon/paypal.png')}}" width="50px" class="" alt="">
                        <p class="mt-3 text-white"> &nbsp;&nbsp;&nbsp;Paypal in 3 interest-free payments on purchase of
                            &pound;30 - &pound;2000.</p>
                        <!-- <a href="#" class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a> -->
                        <!-- <a href="tel:+01234567890" class="text-muted me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a> -->
                        <!-- <a href="mailto:example@gmail.com" class="text-muted me-0"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a> -->
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <img src="{{url('frontendnew/img/icon/klarna2.png')}}" width="40px" class="" alt="">
                        <p class="mt-3 text-white"> &nbsp;&nbsp;&nbsp;Avilable at checkout</p>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar sticky-top px-0 px-lg-4 py-2 py-lg-0">
        <!-- <div class="container"> -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{('/')}}" class="navbar-brand p-0">
                <!-- <h1 class="display-6 text-primary"><i class="fas fa-car-alt me-3"></i></i>Book Driving</h1> -->
                <img src="{{url('frontendnew/img/logo2.png')}}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0 " style="padding-left: 18px;">
                    <a class=" nav-item nav-link {{ Request::is('index') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    <a class=" nav-item nav-link {{ Request::is('bd_aboutUS') ? 'active' : '' }}" href="{{ url('/bd_aboutUS') }}"> About</a>
                    <a class=" nav-item nav-link {{ Request::is('ourServices') ? 'active' : '' }}"  href="{{ url('/ourServices') }}"> Our Services</a>
                    <a class=" nav-item nav-link {{ Request::is('') ? 'active' : '' }}"  href="{{ url('/') }}"> Download Brochure</a>
                    <a class=" nav-item nav-link {{ Request::is('bd_resources') ? 'active' : '' }}"  href="{{ url('/bd_resources') }}"> Resources</a>
                    <a class=" nav-item nav-link {{ Request::is('bd_contact') ? 'active' : '' }}"  href="{{ url('/bd_contact') }}"> Contact</a>


                </div>
                <button class="btn btn-secondary rounded-pill py-2  px-4" style="margin-right:10px"  onclick="openLogin();"> Login</button>
                <a href="#bookform" class="btn btn-warning rounded-pill py-2 px-4">Book Now</a>

            </div>
        </nav>
        <!-- </div> -->
    </div>
    <!-- Navbar & Hero End -->

      

  

