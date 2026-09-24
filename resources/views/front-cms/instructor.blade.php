@extends('front-cms.layouts.main-driver')
@section('main-section')



    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ url('frontendnew/img/instrucotr-bg.png') }}" src="img/instrucotr-bg.png" alt="Image">
                    <div class="carousel-caption1">
                        <div class="container">
                           <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <h1 class="display-22  mb-5 animated slideInDown">The #1 Driving <br>Instructor Software</h1>
                                    <p class="text-dark"><b>Award-winning business management software</b> for driving instructors and multi-car schools. Used by over 6,000 driving instructors every week.</p>
                                    <a href="" class="btn btn-dark py-sm-3 px-sm-5 " >Book an ADI Demo</a>
                                    <a href="" class="btn btn-dark py-sm-3 px-sm-5 mx-3" >PDI Head Start</a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="device-img">
                                            <img src="img/trust-instructor-app.png" width="100%" class="img-fluid" alt="">
                                        </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <h1 class="display-2 text-light mb-5 animated slideInDown">Hassle-Free Learning with No Fees</h1>
                                    <a href="" class="btn btn-primary py-sm-3" style="width: 300px;">Book Now</a><br><br>
                                    <a href="" class="btn btn-light py-sm-3 px-sm-5 " style="width: 300px;">Request for Better Deal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> -->
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <!-- <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-car text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Easy Driving Learn </h5>
                                <span>Master driving with our step-by-step lessons designed for all skill levels, making learning to drive easy and stress-free.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-users text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Certified Instructor</h5>
                                <span>Learn from experienced, certified instructors who provide personalized guidance, ensuring safe, effective, and confident driving skills.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-file-alt text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Get licence</h5>
                                <span>Complete our comprehensive driving program and smoothly transition to earning your licence with expert support and no hidden fees.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Facts End -->

    <div class="container-xxl py-6">
        <div class="container">
            <div class="awards">
               <div class="award1">
                <h4 class="mb-2">Official Partners</h4>
                <img src="img/dia-logo-1-300x66.jpg" width="200px" alt="">
               </div>

               <div class="award2">
                <h4 class="mb-2">Award-Winning</h4>
                <img src="img/award-winning-app.jpg" width="200px" alt="">
               </div>
            </div>

            <div class="videoSec mt-5">
                <iframe width="100%" height="515" src="https://www.youtube.com/embed/BhvcoBr1Iec?si=HotFuNS-X8xq4xFS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>


    <div class="container-xxl py-6 sec3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h1>From only £14 per month</h1>
                    <p>Used by over 5,500 driving instructors and 127,000 pupils every week.</p>
                    <ul>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Online with free Apple app & Android app</li>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Discounts for multi-car instructors</li>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> 100% tax-deductible</li>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> No payment details needed for trial</li>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Free lesson and payment reminders</li>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Free pupil and parent app</li>
                        <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Tailored setup & migration support</li>

                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <img src="img/trustpilotMob.png" alt="">
                </div>
            </div>
          
        </div>
    </div>
    


 

    <!-- Testimonial Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Testimonial</h6>
                <h1 class="display-6 mb-4">What Our Clients Say!</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="img/testimonial-1.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-6">Trust Pilot made learning to drive stress-free. My instructor was patient, professional, and explained everything clearly. I passed my test on the first try, thanks to their guidance. Highly recommend for anyone wanting to learn with confidence!</p>
                            <hr class="w-25 mx-auto">
                            <h5>James T</h5>
                            <span>Dancer</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="img/testimonial-2.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-6">Best decision I made! The flexible scheduling and supportive trainers at Trust Pilot made driving lessons so convenient. My instructor was incredibly knowledgeable, and the online tracking helped me see my progress. Passed my test with flying colors!</p>
                            <hr class="w-25 mx-auto">
                            <h5>David</h5>
                            <span>Shopkeeper</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle mx-auto" src="img/testimonial-3.jpg" alt="">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="fa fa-quote-left fa-2x text-primary"></i>
                                </div>
                            </div>
                            <p class="fs-6">Trust Pilot provided an excellent learning experience. The lessons were tailored to my pace, and the trainer's calm approach helped me feel confident behind the wheel. Affordable, reliable, and highly effective. I’m now a confident, safe driver!</p>
                            <hr class="w-25 mx-auto">
                            <h5>Emily S</h5>
                            <span>Model</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->




@endsection