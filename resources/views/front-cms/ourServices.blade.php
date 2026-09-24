@extends('front-cms.layouts.main')
@section('main-section')
    
<div class="container-fluid py-5" >
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-warning"><b>Our Services</b></h6>
                <h1 class="display-5 text-capitalize mb-3">Building Safe, Confident Drivers</h1>
            </div>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 mb-4 wow fadeInUp text-center" data-wow-delay="0.5s">
                    <div class="blogCard">
                        <a href="weeklyDrivinglession.html"><img src="{{url('frontendnew/img/o1.jpg')}}" width="100%" alt=""></a>
                        <div class="blogCardInner">
                            <h6 class="mt-4 fw--700">Weekly Driving Lesson Packages</h6>
                        <p>We offer weekly driving lesson packages from 4 hours to 50 hours</p>
                                <a href="javascript:void(0)" class="text-warning" data-bs-toggle="modal" data-bs-target="#weeklyModal">
                                    Read More <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>                      
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 mb-4 wow fadeInUp text-center" data-wow-delay="0.6s">
                    <div class="blogCard">
                        <a href=""><img src="{{url('frontendnew/img/o2.jpg')}}" width="100%" alt=""></a>
                        <div class="blogCardInner">
                            <h6 class="mt-4 fw--700">Intensive Lesson Packages</h6>
                        <p>We offer intensive lesson packages from 10 hours per week</p>
                        <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 mb-4 wow fadeInUp text-center" data-wow-delay="0.7s">
                    <div class="blogCard">
                        <a href=""><img src="{{url('frontendnew/img/blog-1.jpg')}}" width="100%" alt=""></a>
                        <div class="blogCardInner">
                            <h6 class="mt-4 fw--700">Performance Coaching</h6>
                        <p>With our performance coaching videos we aim to help you overcome your anxiety</p>
                        <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 mb-4 wow fadeInUp text-center" data-wow-delay="0.5s">
                    <div class="blogCard">
                        <a href=""><img src="{{url('frontendnew/img/o4.jpg')}}" width="100%" alt=""></a>
                        <div class="blogCardInner">
                            <h6 class="mt-4 fw--700">Online Zoom Theory Course</h6>
                        <p>2.5 hour online theory course great for beginners or pupils struggling to revise</p>
                        <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 mb-4 wow fadeInUp text-center" data-wow-delay="0.6s">
                    <div class="blogCard">
                        <a href=""><img src="{{url('frontendnew/img/o5.jpg')}}" width="100%" alt=""></a>
                        <div class="blogCardInner">
                            <h6 class="mt-4 fw--700">Quicker Driving tutorviewquestions</h6>
                        <p>Include a Fast -Tracked driving test which is booked up to 80% quicker</p>
                        <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-xs-12 mb-4 wow fadeInUp text-center" data-wow-delay="0.7s">
                    <div class="blogCard">
                        <a href=""><img src="{{url('frontendnew/img/o6.jpg')}}" width="100%" alt=""></a>
                        <div class="blogCardInner">
                            <h6 class="mt-4 fw--700">Retests</h6>
                        <p>Over 80% of pupils pass their test with us but we can offer retests if required</p>
                        <a href="" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


       <div class="modal fade" id="weeklyModal" tabindex="-1" aria-labelledby="weeklyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="weeklyModalLabel">Weekly Driving Lesson Packages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{url('frontendnew/img/o1.jpg')}}" class="img-fluid mb-3" alt="Weekly Lessons">
                <p>
                    Our Weekly Driving Lesson Packages are tailored to accommodate learners at all stages, 
                    from beginners to those seeking to refine their skills. Spanning from 4 to 50 hours,
                    these packages offer flexibility to fit your schedule and learning pace. Weekly lessons provide consistent practice, 
                    allowing learners to build upon their skills incrementally. This approach ensures
                    better retention of information and steady progress. Our experienced instructors focus on creating a supportive environment,
                    addressing individual needs, and adapting teaching methods to suit each learner. 
                    Regular feedback and assessments help track progress and identify areas for improvement. 
                    By choosing our weekly packages, you're investing in a structured learning path 
                    that promotes confidence and competence on the road. Whether you're a beginner or an experienced driver,
                    our weekly lessons offer a well-rounded approach to driving training. 
                    Join us today and take the first step towards becoming a confident, skilled, and safe driver. 
                    
                     
                </p>
            </div>
            </div>
        </div>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="serlowerSec">
                        <div class="serIcon">
                            <img src="{{url('frontendnew/img/icon/calendar-lines.png')}}" alt="">
                        </div>
                        <div class="textSec">
                            <h5 class="fw--600">Lessons Available to start within weeks</h5>
                            <p class="fs--14">You can start your driving lessons within a matter of weeks.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="serlowerSec">
                        <div class="serIcon">
                            <img src="{{url('frontendnew/img/icon/marker.png')}}" alt="">
                        </div>
                        <div class="textSec">
                            <h5 class="fw--600">Where do we Cover?</h5>
                            <p class="fs--14">We cover 95% of the UK, just enter your postcode to find out if we cover your area.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="serlowerSec">
                        <div class="serIcon">
                            <img src="{{url('frontendnew/img/icon/home.png')}}" alt="">
                        </div>
                        <div class="textSec">
                            <h5 class="fw--600">Pickup/Drop Off from your Postcode</h5>
                            <p class="fs--14">Our instructors will pick you up and drop you off from a postcode of your choice.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="serlowerSec">
                        <div class="serIcon">
                            <img src="{{url('frontendnew/img/icon/smile.png')}}" alt="">
                        </div>
                        <div class="textSec">
                            <h5 class="fw--600">Lessons That Suit You</h5>
                            <p class="fs--14">You can choose lessons to fit around your busy life: Mornings, Afternoons, Evenings or Weekends can all be selected as options when using our system to search for a suitable instructor</p>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="serlowerSec">
                        <div class="serIcon">
                            <img src="{{url('frontendnew/img/icon/credit-card.png')}}" alt="">
                        </div>
                        <div class="textSec">
                            <h5 class="fw--600">Low Deposit Payment</h5>
                            <p class="fs--14">At checkout you can pay a small deposit now and pay the rest to your instructor when you start lessons</p>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="serlowerSec">
                        <div class="serIcon">
                            <img src="{{url('frontendnew/img/icon/credit-card.png')}}" alt="">
                        </div>
                        <div class="textSec">
                            <h5 class="fw--600">Early Driving Test (Within 2 to 8 Weeks)</h5>
                            <p class="fs--14">Get an early driving test within 2 to 8 weeks, avoiding long waits. Book now for faster test availability! &nbsp;&nbsp; <a href="{{ route('driving.test.form') }}" class="text-warning"> Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a></p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
  document.querySelectorAll('.openModal').forEach(button => {
    button.addEventListener('click', () => {
      const title = button.getAttribute('data-title');
      const img = button.getAttribute('data-img');
      const desc = button.getAttribute('data-desc');

      document.getElementById('serviceModalLabel').innerText = title;
      document.getElementById('modalImage').src = img;
      document.getElementById('modalDescription').innerText = desc;

      const modal = new bootstrap.Modal(document.getElementById('serviceModal'));
      modal.show();
    });
  });
</script>
@endsection