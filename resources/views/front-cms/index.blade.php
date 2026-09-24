@extends('front-cms.layouts.main')
@section('main-section')
<style>
    .carousel-item .carousel-caption {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        bottom: 0;
        background: none !important;
        display: flex;
        align-items: center;
    }

    .quick-connect {
        position: fixed;
        bottom: 20%;
        right: 0;
        z-index: 999999;
    }
    .call {
        background-color: white;
        color: white;
        font-size: 20px;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
        /* border-radius: 0 10px 10px 0; */
        height: 50px;
        width: 50px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
    }
    .whatsapp {
        background-color: #66df57;
        color: #fff;
        font-size: 23px;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
        /* border-radius: 0 10px 10px 0; */
        height: 50px;
        width: 50px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

</style>
<style>
    /* Floating Button Styles */
    .whatsapp-float, .call-float {
    position: fixed;
    bottom: 20px;
    z-index: 1000;
    cursor: pointer;
    }

    .whatsapp-float {
    right: 20px;
    }

    .call-float {
    right: 80px;
    }

    .whatsapp-float img, .call-float img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    transition: transform 0.3s;
    }

    .whatsapp-float img:hover, .call-float img:hover {
    transform: scale(1.1);
    }
</style>
<style>
  html {
    scroll-behavior: smooth;
  }
</style>


    <!-- Carousel Start -->
    <div class="header-carousel">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="First slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                <!-- <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li> -->
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{url('frontendnew/img/b1.jpg')}}" class="img-fluid w-100" alt="First slide" />
                    <div class="carousel-caption">
                        <div class="container py-4">
                            <div class="row g-5">
                                <div class="col-lg-6 d-none d-lg-flex fadeInRight animated" data-animation="fadeInRight"
                                    data-delay="1s" style="animation-delay: 1s;">
                                    <!-- <div class="text-start"> -->
                                        
                                        <!-- <h1 class="display-5 text-white">Automatic or Manual Lessions Available </h1> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('driving.test.form') }}" class="btn btn-primary" 
                        style="margin-top: 20pc;color: #000;background-color: #ffc107;border-color: #ffc107;">
                            EARLY PRATICAL TEST BOOKING</a>
                    </div>
                </div>
                  <div class="carousel-item">
                    <img src="{{url('frontendnew/img/b2.jpg')}}" class="img-fluid w-100" alt="Third slide" />
                    <div class="carousel-caption">
                        <div class="container py-4">
                            <div class="row g-5">
                                <div class="col-lg-6 d-none d-lg-flex fadeInRight animated" data-animation="fadeInRight"
                                    data-delay="1s" style="animation-delay: 1s;">
                               
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('driving.test.form') }}" class="btn btn-primary" style="margin-top: 20pc;color: #000;background-color: #ffc107;border-color: #ffc107;">EARLY PRATICAL TEST BOOKING</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
    <div class="container-fluid search-sec bg-secondary" id="bookform">
        <div class="container py-5">

        <form action="{{ url('/advanceSearch') }}" method="GET" onsubmit="return validatePostcode()">
            <h5 class="text-center text-white">Enter your postcode and mobile number to find a driving instructor in
                your area</h5>
            <div class="row mt-5">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                    <input type="text" class="form-control" placeholder="Post Code"  name="postcode" required>
                    <small class="smallNote"><input type="checkbox" name="opt_in"> Opt-in to be contacted about offers (uncheck to
                        opt-out)</small>
                        <span id="postcode-error" style="color: red;"></span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                    <input type="number" class="form-control" placeholder="Mobile Number" name="mobile_number" required>
                </div>
        
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                    <button type="submit" class="btn btn-warning" style="width: 100%;"><i class="fa fa-search"></i>
                        Search</button>
                </div>
        
            </div>
            <div class="row mt-4">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                    <div class="text-center">
                        <img src="{{url('frontendnew/img/icon/location.png')}}" width="80px" alt="">
                        <h5 class="text-white mt-3">Enter Postcode</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                    <div class="text-center">
                        <img src="{{url('frontendnew/img/icon/requirements.png')}}" width="80px" alt="">
                        <h5 class="text-white mt-3">Select Requirements</h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-4">
                    <div class="text-center">
                        <img src="{{url('frontendnew/img/icon/sedan.png')}}" width="80px" alt="">
                        <h5 class="text-white mt-3">Start Your Lessons</h5>
                    </div>
                </div>
            </div>
        </form>


        </div>
    </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="dataFactor bg-warning">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-thumbs-up fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">829</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h6 class="text-white mb-0">Excellent Reviews </h6>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-map fa-2x"></i>

                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">56</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h6 class="text-white mb-0">UK Coverage</h6>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">17</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h6 class="text-white mb-0">Years Of Experience </h6>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="counter-item text-center">
                            <div class="counter-item-icon mx-auto">
                                <i class="fas fa-car fa-2x"></i>
                            </div>
                            <div class="counter-counting my-3">
                                <span class="text-white fs-2 fw-bold" data-toggle="counter-up">589</span>
                                <span class="h1 fw-bold text-white">+</span>
                            </div>
                            <h6 class="text-white mb-0">Professional Instructors</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- About Start -->
    <div class="container-fluid overflow-hidden about py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item">
                        <div class="pb-5 text-center">
                            <h1 class="display-5 text-capitalize">ABOUT US AND OUR SERVICES​
                            </h1>
                            <p class="mb-0">Welcome to Book Driving, where we prioritize safe and confident driving
                                skills for all our students. With a team of certified and experienced instructors, we’re
                                committed to providing personalized, high-quality driving lessons that cater to every
                                skill level, from beginners to those seeking advanced training. Our mission is to
                                empower students to become responsible, skilled drivers while making the learning
                                process enjoyable and stress-free.
                            </p>
                        </div>
                       
                    </div>
                </div>

                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="about-item-inner border p-4">
                                    <div class="about-icon mb-4">
                                        <img src="{{url('frontendnew/img/about-icon-2.png')}}" class="img-fluid w-50 h-50" alt="Icon">
                                    </div>
                                    <h5 class="mb-3">Our Vision</h5>
                                    <p class="mb-0">To create a community of safe, skilled, and confident drivers who
                                        prioritize road safety and responsibility.

                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-item-inner border p-4">
                                    <div class="about-icon mb-4">
                                        <img src="{{url('frontendnew/img/about-icon-2.png')}}" class="img-fluid h-50 w-50" alt="Icon">
                                    </div>
                                    <h5 class="mb-3">Our Mision</h5>
                                    <p class="mb-0">To deliver exceptional driving education with personalized training,
                                        fostering lifelong safe driving habits.</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-item my-4">At Book Driving, we offer a range of tailored driving courses,
                            including beginner lessons, refresher courses, and intensive programs for experienced
                            drivers. We also provide specialized training for highway driving, defensive driving, and
                            parking skills, ensuring comprehensive preparation for the road.
                        </p>
                        
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <iframe width="100%" height="350"
                        src="https://www.youtube.com/embed/1FTbLSLbfqg?si=p_8GeOZxBsMvO3pl')}}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                   
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




   <!-- <div class="container-fluid lessionSec">
        <div class="container text-center">
            <div class="lessionSec-inner">
                <h1 class=" text-white my-5">Your Driving Lesson​ <br><span class="text-warning">Is Just a Few Clicks
                        Away</span></h1>

                <p class="smalls" style="background-color:black;">The main benefit of booking with Book Instructor is you only have to enquire once and
                    we do the hard work, don’t spend days on end texting and calling local instructors to try and get
                    booked in – our online portal has access to dozens of local instructors.</p>
                <p class="smalls" style="background-color:black;">In cases where we cannot allocate immediately, we will contact as many ADIs as is
                    necessary in your area until we have successfully allocated your booking.</p>
                <p class="smalls" style="background-color:black;">If we cannot get you a driving instructor then we have a 100% refund guarantee</p>

                <br>
                <br>
                <a href="bd_contact">
                <button class="btn btn-warning">Read More</button></a>
                <br><br>
            </div>
        </div>
    </div>

    <div class="container-fluid lessionSec-below">
        <div class="container text-center">
            <div class="below-box-row">
                <div class="below-box  wow fadeInUp">
                    <img src="{{url('frontendnew/img/icon/money.png')}}"  alt="">
                    <h6>Small Deposit</h6> 
                    <small>Book an instructor online with a small deposit</small>
                </div>
                <div class="below-box  wow fadeInUp">
                    <img src="{{url('frontendnew/img/icon/steering-wheel.png')}}" alt="">
                    <h6>Get Driving</h6> 
                    <small>Start your lessons within weeks</small>
                </div>
                <div class="below-box  wow fadeInUp">
                    <img src="{{url('frontendnew/img/icon/instructor.png')}}" alt="">
                    <h6>Instructors</h6> 
                    <small>Fully DVSA approved & DBS checked driving instructors      </small>
                </div>
            </div>
        </div>
    </div>

   -->
    <!-- <a href="https://wa.me/+447960 520269" class="whatsapp-float" target="_blank" title="Chat on WhatsApp">
        <img src="https://img.icons8.com/color/48/000000/whatsapp.png" alt="WhatsApp">
    </a>

    <a href="tel:+44 7960 520269" class="call-float" title="Call Now">
        <img src="https://img.icons8.com/color/48/000000/phone.png" alt="Call">
    </a> -->

    <div class="quick-connect">
        <div class="call">
            <a href="tel:+442039961777">
                <img src="https://img.icons8.com/color/48/000000/phone.png" style="color: white;" alt="Call">
            </a>
        </div>
        <div class="whatsapp">
            <a href="https://wa.me/447944661936" target="blank">
                 <img src="https://img.icons8.com/color/48/000000/whatsapp.png" alt="WhatsApp">
            </a>
        </div>
        </div>
    <!-- Services Start -->
    <div class="container-fluid" >
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-warning"><b>Driving Lessons</b></h6>
                <h1 class="display-5 text-capitalize mb-3">Professional Driving Lessons</h1>
                <p class="mb-0">All of our instructors are qualified, professional and experienced.</p>
            </div>
            <div class="row g-4">
               
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                   <div class="drivingLessionSec">
                    <img src="{{url('frontendnew/img/dLession (1).png')}}" width="100%" alt="">

                    <div class="drivingLessioncard">
                        <img src="{{url('frontendnew/img/icon/gear.png')}}"  width="40px" class="m-4" alt="">
                        <h6 class="fw--600">Small Deposit</h6>
                        <p>We can allocate you a driving instructor with an automatic vehicle to teach you in</p>
                    </div>
                   </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="drivingLessionSec">
                     <img src="{{url('frontendnew/img/dLession (2).png')}}" width="100%" alt="">
 
                     <div class="drivingLessioncard">
                         <img src="{{url('frontendnew/img/icon/test.png')}}"  width="40px" class="m-4" alt="">
                         <h6 class="fw--600">Automatic Lessons</h6>
                         <p>We can allocate you a driving instructor with an automatic vehicle to teach you in</p>
                     </div>
                    </div>
                 </div>

                 <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="drivingLessionSec">
                     <img src="{{url('frontendnew/img/dLession (3).png')}}" width="100%" alt="">
 
                     <div class="drivingLessioncard">
                         <img src="{{url('frontendnew/img/icon/traffic-light-go.png')}}"  width="40px" class="m-4" alt="">
                         <h6 class="fw--600">Fully DVSA approved & DBS checked driving instructors</h6>
                         <p>We can allocate you a driving instructor with an automatic vehicle to teach you in</p>
                     </div>
                    </div>
                 </div>
                
            </div>
        </div>
    </div>
    <!-- Services End -->















<script>
//alert();
    // Remove spaces as the user types
    function removeSpaces() {
        var postcodeField = document.getElementById('postcode');
        postcodeField.value = postcodeField.value.replace(/\s+/g, ''); // Remove all spaces
    }

    // Validate postcode before form submission using jQuery AJAX
    function validatePostcode() {
        var postcode = $('#postcode').val().trim();
//alert(postcode);
        // Check if the postcode is not empty
        if (postcode === "") {
            $('#postcode-error').text("Postcode is required.");
            return false;
        }

        // Use jQuery AJAX to check the postcode against the database
        $.ajax({
            url: '/checkPostcode/' + postcode,
            type: 'GET',
            success: function(response) {
                if (response === "valid") {
                    // Postcode is valid
                    return true;
                } else {
                    // Postcode is invalid
                    $('#postcode-error').text("Postcode prefix is not valid.");
                    return false;
                }
            },
            error: function() {
                // If an error occurs during the AJAX request
                $('#postcode-error').text("There was an error with the request. Please try again.");
                return false;
            }
        });

        return false; // Prevent form submission until AJAX is complete
    }
</script>




@endsection