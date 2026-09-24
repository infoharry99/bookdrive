@extends('front-cms.layouts.main')
@section('main-section')
    <!-- tutor section -->
    <section class="tutor-details">
        <div class="container tutor-card topheader-tutor">

            <div class="row">

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 profileSec1">
                    <h2>{{ $tutorpd->headline }}</h2>

                    <!-- <h6 class="mb-2">Subjects </h6>

                    <div class="sub-btns">
                        @foreach ($subjects as $subject)
    <button>{{ $subject->subject_name }}</button>
    @endforeach
                    </div> -->

                    <div class="aboutTutor">

                        <h5>About {{ $tutorpd->name }}</h5>
                        <p class="charcol">{{ $tutorpd->goal }}</p>
                        {{-- <h5 class="">About the lesson</h5>
                        <p class="charcol">Have trouble understanding your workload? There are a million tutors, and you
                            have landed on the right page.<br><br> Hi, My name's Mr. Thompson, and I have the patience
                            and key to your understanding. I am a dynamic tutor. I know your needs change from session
                            to session. <br><br> That's why I provide 3 different rate prices just for you. I have the
                            notes and recordings that can help you. <br><br> I look forward to your message because I'm
                            a fast responder; Oh, and before I forget the most important thing, you can get answers to
                            questions and concepts from me even outside of scheduled classes.</p> --}}
                    </div>



                    <div class="aboutTutor review-top">
                        <h5>Review</h5>
                        <div class="star">
                            <span>
                                <i class="fa fa-star"></i> {{ $averagereview->avg_rating ?? '0' }}
                                ({{ $averagecount ?? '0' }}
                                reviews)
                            </span>
                        </div>
                    </div>


                    <div class="row mt-4">
                        @foreach ($reviews as $review)
                            <div class="col-12 mb-4">

                                <div class="review-text">
                                    <div class=" review-top">
                                        <h6>{{ $review->student_name }}</h6>
                                        <div class="star">
                                            <span>
                                                <i class="fa fa-star"></i> {{ $review->ratings }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="charcol font-14">{{ $review->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>



                    <div class="aboutTutor">
                        <h5>{{ $tutorpd->name }}'s Video</h5>

                        <div class="tutor-Video">
                            <iframe width="100%" height="400" src="{{ $tutorpd->intro_video_link }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="tutorDetails tutorProfPic mar-top-40">
                        <div class="row">
                            <div class="col-lg-12 col-md-5">

                                <div class="tutorImg">
                                    <img src="{{ url('images/tutors/profilepics', '/') }}{{ $tutorpd->profile_pic }}"
                                        width="100%" alt=""
                                        onerror="this.onerror=null;this.src='https://mychoicetutor.com/frontendnew/img/icons/mct-favicon.png';">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-7">

                                <p class="name mt-3">{{ $tutorpd->name }}</p>
                                <div class="star">
                                    <span>
                                        <i class="fa fa-star"></i>
                                        {{ $averagereview->avg_rating ?? '0' }} ({{ $averagecount ?? '0' }})
                                    </span>

                                </div>


                                <!-- <table class="priceTable">
                                    <tr>
                                        <td>Hourly rate</td>
                                        <td>£{{ $tutorpd->rateperhour }}</td>
                                    </tr>
                                   
                                </table> -->

                                <div class="tabView">
                                    <div class="freeTrial btnSize ">
                                        {{-- <a href="/free-trial-class/student-login/{{ $tutorpd->tutor_id }}" class="btn">Check Slots</a> --}}
                                        <a href="#checkslots" onclick="openslotsmodal({{ $tutorpd->tutor_id }});"
                                            class="btn">Check Slots</a>
                                    </div>

                                    <div class="expMore btnSize">
                                        <a href="/enroll-class/student-login/{{ $tutorpd->tutor_id }}"
                                            class="btn">Enroll
                                            Now</a>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>



                <!-- -------------- -->
                <!-- <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="tutorDetails tutorProfPic mar-top-40">
                        <div class="row">
                            <div class="col-lg-12 col-md-5">
                                <div class="tutorImg">
                                    <img src="{{ url('images/tutors/profilepics', '/') }}{{ $tutorpd->profile_pic }}"
                                        width="100%" alt=""
                                        onerror="this.onerror=null;this.src='https://mychoicetutor.com/frontendnew/img/icons/mct-favicon.png';">

                                </div>


                            </div>
                        </div>
                        <div class="col-lg-12 col-md-7">

                            <p class="name mt-3">{{ $tutorpd->name }}</p>
                            <div class="star">
                                <span>
                                    <i class="fa fa-star"></i>
                                    {{ $averagereview->avg_rating ?? '0' }} ({{ $averagecount ?? '0' }})
                                </span>

                            </div>


                            <table class="priceTable">
                                <tr>
                                    <td>Hourly rate</td>
                                    <td>£{{ $tutorpd->rateperhour }}</td>
                                </tr>

                            </table>

                            <div class="tabView">
                                <div class="freeTrial btnSize ">
                                    <a href="/free-trial-class/student-login/{{ $tutorpd->tutor_id }}" class="btn">Free
                                        Trial Class</a>
                                </div>

                                <div class="expMore btnSize">
                                    <a href="/enroll-class/student-login/{{ $tutorpd->tutor_id }}" class="btn">Enroll
                                        Now</a>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>  -->

                <!-- -------- -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="slotmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Available Slots</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="full-width-table-responsive">
                            <table class="table table-hover table-striped align-middle table-nowrap mb-0 users-table"
                                style="height: 260px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Slots</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedSlots as $date => $slots)
                                        <tr>
                                            <td>{{ $date }}</td>
                                            <td>
                                                @foreach ($slots as $slot)
                                                    @php
                                                        // Convert the time string to a Carbon instance for formatting
                                                        $formattedTime = \Carbon\Carbon::parse($slot['time'])->format(
                                                            'h:i A',
                                                        );
                                                    @endphp
                                                    <a href="/free-trial-class/student-login/{{ $tutorpd->tutor_id }}"
                                                        class="btn">
                                                        <button type="button"
                                                            class="slot-btn btn btn-sm btn-{{ $slot['is_available'] ? 'success' : 'danger' }}"
                                                            data-date="{{ $date }}"
                                                            data-time="{{ $formattedTime }}"
                                                            data-slot-id="{{ $slot['id'] }}"
                                                            {{ $slot['is_available'] ? '' : 'disabled' }}>
                                                            {{ $formattedTime }}
                                                        </button>
                                                    </a>
                                                @endforeach

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <script>
            function openslotsmodal(id) {
                $('#slotmodal').modal('show');
            }
        </script>




    </section>
@endsection
