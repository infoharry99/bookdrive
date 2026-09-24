@extends('front-cms.layouts.main')
@section('main-section')
<!-- END header -->
<section class="bannerSec tutBann bg-gradient">
    <div class="container-fluid">
        <div class="tutorHeader ">
           
            <h1 class="findtutorHeader" style="align-content: center; align-self:center; align-items:center">
                Discover the perfect tutor for you
            </h1>
            <form action="{{ url('toptutorsearch') }}" method="POST">
                @csrf
                <div class="findtutor-btns">
                    <div class="custom-select" style="width:300px;">
                        <select id="grade" name="grade">
                            <option value="">Select City</option>
                            @foreach ($gradelists as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="custom-select" style="width:300px;">
                        <select id="subject" name="subject">
                            <option value="">Select Area</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    


                    <div class="drpdwnSearch">
                        <button type="submit" class="btn search-tutor">Search</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
</section>

<!-- tutor section -->
<section class="findtutSecs mar-top-40">
    <div class="container tutor-card">
        <h4>10 million evaluated private tutors</h4>
        <br>
        <div class="row">
            @foreach ($tutors as $tutor)
            <a href="tutor-details/{{$tutor->tutor_id}}" style="color: black">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 tutorCol mb-5">
                    <div class="tutorDetails padd-50">
                        <div class="tutorImg">
                            <img src="{{ url('images/tutors/profilepics', '/') }}{{ $tutor->profile_pic }}" width="100%" alt="" onerror="this.onerror=null;this.src='https://mychoicetutor.com/frontendnew/img/icons/mct-favicon.png';">
                        </div>
                        <div class="star">
                            <span>
                                <i class="fa fa-star"></i>
                                {{$tutor->avg_rating}} ({{$tutor->total_reviews}})
                            </span>
                            <span>${{$tutor->rateperhour}}/h</span>
                        </div>
                        <a href="tutor-details/{{$tutor->tutor_id}}" style="color: black"><span class="name">
                                {{$tutor->name}}
                                <p>{{$tutor->subject}}</p>
                            </span></a>
                        <span class="desc-tutor">{{$tutor->headline}}</span>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
        {{-- <div class="row mt-4">
                <div class="col-12">
                    <div class="expMore">
                        <a href="#" class="btn btn-lg">Explore more</a>
                    </div>
                </div>
            </div> --}}
    </div>
</section>

<section>
    <div class="container">
        <div class=" bottom-banner1 ">

            <div class="rightside">
            <h2>Experience our free trial classes today!</h2>
            <button onclick="redirect();">Book free trial class today</button>
            </div>

        </div>
    </div>
    <script>
    function redirect() {
        window.location.href = "{{('/student/register')}}";
    }
    </script>
</section>

@endsection