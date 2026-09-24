@extends('front-cms.layouts.main')
@section('main-section')


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
                                        <img src="{{url('frontendnew/img/icon/about-icon-1.png')}}" class="img-fluid w-50 h-50" alt="Icon">
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
                    <h5 class="fw--600">Watch our short video to learn everything about what book driving offers</h5>
                    <iframe width="100%" height="350"
                        src="https://www.youtube.com/embed/1FTbLSLbfqg?si=p_8GeOZxBsMvO3pl" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                    
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <div class="container-fluid overflow-hidden about py-5 scheduleSec">
        <div class="container pt-5">
            <div class="scheduleSecInner">
                <div>
                    <h3 class="fw-700"> Schedule Your Driving <br> Lessons Now</h3>
                    <p>Don’t leave it to chance, get booked in today!</p>
                </div>
                <div>
                    <a href="#" class="btn btn-warning rounded-pill py-2 px-4">Book Now</a>
                </div>
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

    <div class="container-fluid py-5" >
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-warning"><b>Driving Lessons</b></h6>
                <h1 class="display-5 text-capitalize mb-3">Latest Blog & Articles</h1>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.7s">
                    <img src="{{url('frontendnew/img/blog-1.jpg')}}" width="100%" alt="">
                    <h6 class="mt-4 fw--700">NEW DVSA publish top 10 Fail Reasons</h6>
                    <p>NEW DVSA publish top 10 Fail Reasons Top 10 Reasons Why People Fail Driving Tests in 2024 and How...</p>
                    <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.7s">
                    <img src="{{url('frontendnew/img/blog-1.jpg')}}" width="100%" alt="">
                    <h6 class="mt-4 fw--700">DVSA recruiting 200 new examiners to reduce the driving test backlog by 230,000.</h6>
                    <p>DVSA recruiting 200 new examiners to reduce the driving test backlog. The DVSA (Driver and Vehicle Standards Agency) is...</p>
                    <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.7s">
                    <img src="{{url('frontendnew/img/blog-1.jpg')}}" width="100%" alt="">
                    <h6 class="mt-4 fw--700">RAC Calls for Increased Driving Test Fees for Repeat Failures</h6>
                    <p>RAC Calls for Increased Driving Test Fees for Repeat Failures Are you tired of trying to book driving lessons...</p>
                    <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>



@endsection