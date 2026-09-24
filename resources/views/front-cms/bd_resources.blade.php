@extends('front-cms.layouts.main')
@section('main-section')


   

<div class="container-fluid py-5" >
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-warning"><b>Our Resources</b></h6>
                <h1 class="display-5 text-capitalize mb-3">browse all of our resources by category below</h1>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp text-center mb-4" data-wow-delay="0.5s">
                    <div class="resourcemenu">
                        <a href="">
                            <img src="{{url('frontendnew/img/icon/road.png')}}" width="50px" alt="">
                        <h5 class="mt-4 fw--700">Learning to Drive</h5>
                        </a>
                        <a href="" class="text-warning"> View Resources <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp text-center mb-4" data-wow-delay="0.5s">
                    <div class="resourcemenu">
                        <a href="">
                            <img src="{{url('frontendnew/img/icon/book-alt.png')}}" width="50px" alt="">
                        <h5 class="mt-4 fw--700">Theory Test</h5>
                        </a>
                        <a href="" class="text-warning"> View Resources <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp text-center mb-4" data-wow-delay="0.5s">
                    <div class="resourcemenu">
                        <a href="">
                            <img src="{{url('frontendnew/img/icon/car-alt.png')}}" width="50px" alt="">
                        <h5 class="mt-4 fw--700">Manoeuvres</h5>
                        </a>
                        <a href="" class="text-warning"> View Resources <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp text-center mb-4" data-wow-delay="0.5s">
                    <div class="resourcemenu">
                        <a href="">
                            <img src="{{url('frontendnew/img/icon/traffic-light-go.png')}}" width="50px" alt="">
                        <h5 class="mt-4 fw--700">Driving Test</h5>
                        </a>
                        <a href="" class="text-warning"> View Resources <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 wow fadeInUp text-center mb-4" data-wow-delay="0.5s">
                    <div class="resourcemenu">
                        <a href="">
                            <img src="{{url('frontendnew/img/icon/info.png')}}" width="50px" alt="">
                        <h5 class="mt-4 fw--700">Useful Information</h5>
                        </a>
                        <a href="" class="text-warning"> View Resources <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>

                

            </div>
        </div>


       
    </div>


@endsection