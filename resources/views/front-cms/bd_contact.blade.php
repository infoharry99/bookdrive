@extends('front-cms.layouts.main')
@section('main-section')
<div class="container-fluid overflow-hidden about py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-xl-12 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="about-item">
                        <div class="pb-5 text-center">
                            <h1 class="display-5 text-capitalize">Contact Us
                            </h1>
                           <a href="" class="btn btn-lg px-5  btn-warning">Already booked with us? click here to view your live booking status</a>
                           <p class="py-3">Complete the form below if you would like to contact us</p>
                           <p class="mb-3">Working Hours are: <br>Monday – Saturday 09:00 – 17:00 <br>We are closed on Christmas Day, Boxing Day & New Years Day.</p>

                           <label for=""><b>Enquiry Type <i class="text-warning">*</i></b></label>
                           <select class="form-control" name="" id="" style="width: 60%; margin: 0 auto;">
                            <option value="">I am a new customer interested in booking</option>
                            <option value="">I am an existing customer and I've already booked</option>
                            <option value="">I am a driving instructor</option>
                           </select>
                           <button class="btn  btn-warning mt-3 px-4">NEXT</button>
                        </div>

                    </div>
                </div>


                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4 fadeInUp" data-wow-delay="0.1s">
                    <div class="contact">
                        <div class="contact-add-item p-4">
                            <div class="contact-icon mb-4">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4>Head Office</h4>
                                <p class="mb-0">Book Driver <br> 5 Brentwick Gardens Brentford London TW89QL </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4 fadeInUp" data-wow-delay="0.1s">
                    <div class="contact">
                        <div class="contact-add-item p-4">
                            <div class="contact-icon mb-4">
                                <i class="fa fa-phone fa-2x"></i>
                            </div>
                            <div>
                                <h4>Contact No.</h4>
                                <p class="mb-0"> +44 20 3996 1777‬</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4 fadeInUp" data-wow-delay="0.1s">
                    <div class="contact">
                        <div class="contact-add-item p-4">
                            <div class="contact-icon mb-4">
                                <i class="fas fa-envelope fa-2x"></i>
                            </div>
                            <div>
                                <h4>Email</h4>
                                <p class="mb-0">maryan063@icloud.com </p>
                            </div>
                        </div>
                    </div>
                </div>

              
            </div>
        </div>
    </div>


@endsection