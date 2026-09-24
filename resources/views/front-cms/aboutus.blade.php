@extends('front-cms.layouts.main')
@section('main-section')
<section class="bannerSec tutBann bg-gradient">
    <div class="container-fluid">
        <div class="tutorHeader ">
            <h1 class="mb-5">
            Driving Success: Our Story, Values, <br> and Commitment to Your Road Safety
            </h1>

            

        </div>
    </div>
    </div>
</section>
<!-- tutor section -->
<section class="mt-5">
    <div class="container ">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h1>About Us</h1>
            <p class="my-3">At 121 Driving School, we are committed to empowering our students with the skills and confidence needed to become safe, responsible drivers. With years of experience in driver education, our mission is to provide personalized, one-on-one instruction tailored to each student's unique learning style and pace. We understand that learning to drive can be daunting, which is why our professional, friendly instructors are dedicated to creating a calm and supportive learning environment.</p>
            <p class="my-3">
            Whether you’re a complete beginner or need a refresher, our team is here to guide you through every step of your driving journey—from mastering the basics to passing your driving test with confidence. We believe that safe driving habits are the key to road safety, and our goal is to ensure every student becomes a competent, defensive driver for life.
            </p>
            <p>At 121 Driving School, your success on the road is our top priority.</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <img class="img-fluid mt-5" src="{{url('frontendnew/img/aboutImg2.png')}}" width="100%" alt="">
        </div>
    </div>

       
    </div>

</section>

<section class="howitwork-sec">
    <div class="container topheader">
        <h3 class="">How it works</h3>
        <p class="text-center px-5 mb-5">Experience seamless learning with our online tuition app. We've simplified
            education, making
            it easy for students, parents, and tutors to connect and excel. Effortless, effective, and engaging learning
            awaits you.</p>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                <div class="how-card card1">
                    <span class="nameTo">Book Your Lesson</span>
                    <p class="mt-4 pb-5">Use our easy online booking system or call us directly to schedule your first lesson at a time that suits you.</p>
                </div>
                <!-- <div class="imgNumber">
                    <img class="shaddow" src="{{ url('frontendnew/img/icons/Vector 1.png') }}" alt="">
                    <img class="numbr1" src="{{ url('frontendnew/img/icons/one.png') }}" alt="">
                </div> -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                <div class="how-card card2">
                    <span class="nameTo">Personalized Assessment</span>
                    <p class="mt-4 pb-5">During the first lesson, your instructor will assess your skill level and tailor future lessons accordingly.</p>
                </div>
                <!-- <div class="imgNumber">
                    <img class="shaddow" src="{{ url('frontendnew/img/icons/Vector 2.png') }}" alt="">
                    <img class="numbr2" src="{{ url('frontendnew/img/icons/two.png') }}" alt="">
                </div> -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                <div class="how-card card3">
                    <span class="nameTo">Practice & Perfect</span>
                    <p class="mt-4 pb-5">We focus on practical driving experience in real-world situations, along with test preparation.</p>
                </div>
                <!-- <div class="imgNumber">
                    <img class="shaddow" src="{{ url('frontendnew/img/icons/Vector 3.png') }}" alt="">
                    <img class="numbr3" src="{{ url('frontendnew/img/icons/three.png') }}" alt="">
                </div> -->
            </div>
        </div>
    </div>
</section>


@endsection