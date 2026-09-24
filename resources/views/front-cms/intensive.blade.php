@extends('front-cms.layouts.main')
@section('main-section')
<div class="container-fluid py-3 bg-secondary">
        <div class="container">
            <div class="advSearchSec">
                <form action="{{ url('advanceSearchForm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="postcode" value="{{ request()->get('postcode') }}">
                    <input type="hidden" name="mobile_number" value="{{ request()->get('mobile_number') }}">
                    <input type="hidden" name="opt_in" value="{{ request()->get('opt_in') }}">
                    <div class="row">
                         <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="lessonstype" id="weekly" value="weekly" onclick="openweekly();"  />
                                <div class="weeklyBtn">
                                    <p>Weekly</p>
                                    <p>(2-8 hours per week)</p>
                                </div>
                            </div>
                            @error('lessonstype')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="lessonstype" value="intensive" id="intensive" {{ 'checked' }} onclick="openintensive();"/>
                                <div class="weeklyBtn">
                                    <p>Intensive</p>
                                    <p>(10+ hours per week)</p>
                                </div>
                            </div>
                            @error('lessonstype')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <h6 class="text-white text-center fw--700">Select your Transmission</h6>
                            <div class="row manAuto">
                                <div class="col-6">
                                    <div class="weeklyBox">
                                        <input type="radio" name="transmission" id="manual" checked />
                                        <div class="weeklyBtn">
                                            <p class="">Manual</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="weeklyBox">
                                        <input type="radio" name="transmission" id="auto" />
                                        <div class="weeklyBtn">
                                            <p class="">Automatic</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <h6 class="text-white text-center fw--700">Include a Fast-Tracked Theory Test
                                <i class="fa fa-info-circle" style="cursor: pointer;" onclick="fastrackInfo();"></i>
                            </h6>
                            <div class="row manAuto">
                                <div class="col-6">
                                    <div class="weeklyBox">
                                        <input type="radio" name="fasttrack" id="ft-yes" onclick="fasttrackYes();"
                                            checked />
                                        <div class="weeklyBtn">
                                            <p class="">Yes</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="weeklyBox">
                                        <input type="radio" name="fasttrack" id="ft-no" onclick="fasttrackNo();"
                                            checked />
                                        <div class="weeklyBtn">
                                            <p class="">No</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="includeOurUltimateTheory" hidden>

                        <h6 class="text-white text-center fw--700">Ultimate Theory Package?</h6>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="spreadoutLesson" id="sol-yes" checked />
                                <div class="weeklyBtn">
                                    <p class="">Yes</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="spreadoutLesson" id="sol-no" />
                                <div class="weeklyBtn">
                                    <p class="">No</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12" style="line-height: 10px;">
                            <h6 class="text-white text-center fw--700">Include a Fast-Tracked Driving Test <i
                                    class="fa fa-info-circle" style="cursor: pointer;" onclick="fastrackInfo();"></i>
                            </h6>
                            <p class="perfCoach" onclick="fastrackInfo();"><u>+ FREE performance coach course</u></p>
                        </div>

                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="fasttrackdriving" id="ftd-yes" checked
                                    onclick="includeFTDyes()" />
                                <div class="weeklyBtn">
                                    <p class="">Yes</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="fasttrackdriving" id="ftd-no" onclick="includeFTDno()" />
                                <div class="weeklyBtn">
                                    <p class="">No</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="haveUbookedDT" hidden>
                        <div class="col-12">
                            <h6 class="text-white text-center fw--700">Have you booked a driving test?</h6>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="bookedDrivingtest" id="bdt-yes"
                                    onclick="haveYouBookedYes();" />
                                <div class="weeklyBtn">
                                    <p class="">Yes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="bookedDrivingtest" id="bdt-no" onclick="haveYouBookedNo();" />
                                <div class="weeklyBtn">
                                    <p class="">No</p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="drivingtestDate" hidden>
                        <div class="col-12">
                            <div class="text-center mb-2" style="line-height: 10px;">
                                <h6 class="text-white text-center fw--700">Driving Test Information</h6>
                                <input type="date" class="form-control mt-2">
                            </div>
                        </div>
                    </div>



                    <div class="text-center mb-2" style="line-height: 10px;">
                        <h6 class="text-white text-center fw--700">Lesson Preferences</h6>

                    </div>
                    <div class="flex-container mb-2">

                        <div class="flex-item weeklyBox">
                            <input type="radio" name="flexible" id="flexible" onclick="handleOptionA()" checked />
                            <div class="weeklyBtn2 pad-20-5">
                                <p class="">Flexible</p>
                            </div>

                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" id="weekly-morning"
                                onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-10-5">
                                <p class="">Weekday Mornings</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" id="weekly-afternoon"
                                onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-10-5">
                                <p class="">Weekday Afternoon</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" id="weekly-evening"
                                onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-10-5">
                                <p class="">Weeklday Evening</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" id="weekend" onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-20-5">
                                <p class="">Weekend</p>
                            </div>
                        </div>

                    </div>


                    <h6 class="text-white text-center fw--700">Select Previous Driving Experience</h6>
                    <select name="driving-experience" class="form-control mb-2" id="">
                        <option value="">Choose an option...</option>
                        <option value="1-10" {{ old('driving-experience') == '1-10' ? 'selected' : '' }}>I have completed 1-10 hours of lessons</option>
                        <option value="11-20" {{ old('driving-experience') == '11-20' ? 'selected' : '' }}>I have completed 11-20 hours of lessons</option>
                        <option value="21-30" {{ old('driving-experience') == '21-30' ? 'selected' : '' }}>I have completed 21-30 hours of lessons</option>
                        <option value="31-40" {{ old('driving-experience') == '31-40' ? 'selected' : '' }}>I have completed 31-40 hours of lessons</option>
                        <option value="41+" {{ old('driving-experience') == '41+' ? 'selected' : '' }}>I have completed 41 or more hours of lessons</option>
                        <option value="refresher" {{ old('driving-experience') == 'refresher' ? 'selected' : '' }}>I have already passed & looking for refresher lessons</option>
                        <option value="extended-test" {{ old('driving-experience') == 'extended-test' ? 'selected' : '' }}>I have been banned previously / taking an extended test</option>
                        <option value="international" {{ old('driving-experience') == 'international' ? 'selected' : '' }}>I am an International licence holder waiting to pass in the UK</option>
                        <option value="no-experience" {{ old('driving-experience') == 'no-experience' ? 'selected' : '' }}>I have no experience at all and I am confident</option>
                    </select>

                    <button type="submit" class="btn btn-warning">VIEW INTENSIVE COURSES</button>
                </form>
            </div>

            <?php 
            $intensive_plans = DB::table('intensive_plans')->get();
            ?>
            @if(isset($admin) && $admin == 1)
                <div class="row courseCard">
                    @foreach($intensive_plans as $plans )
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="courseCardInner">
                                <div class="hrs">
                                    <!-- <div class="digit">
                                        <span>2</span>
                                    </div> -->
                                    <div class="digit">
                                        <span>{{$plans->no_of_class}}</span>
                                    </div>
                                    <div class="level">
                                        <h5>No of Classes:- {{$plans->no_of_class}}</h5>
                                        <!-- <p>Intermediate Course</p> -->
                                    </div>
                                </div>
                            
                                <div class="row mt-2 border-bttm">
                                    <!-- <div class="col-4">
                                        <div class="depositeSec">
                                            <span>Deposit:</span>
                                            <i class="fa fa-info-circle mt-1" onclick="depositOpen();"></i>
                                        </div>
                                        <p>£549.30</p>
                                    </div> -->
                                    <!-- <div class="col-4">
                                        <span>Pay Instructor:</span>
                                        <p>£1,368.00</p>
                                    </div> -->
                                    <div class="col-4">
                                        <span>Total Price:</span>
                                        <p>£{{$plans->rate}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="duration mt-2">
                                            <div> <i class="fa fa-calendar"></i></div>
                                            <div>
                                                <p>No of Classes:-  {{$plans->no_of_class}}</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="suitable">
                                            <p class="fw--700">This course is suitable for:</p>
                                            <div class="suitableInner mt-2">
                                                <div> <i class="fa fa-check-circle"></i></div>
                                                <div>
                                                    <p>{{$plans->detail}}</p>
                                                </div>
                                            </div>
                                            <form id="bookNowForm-1" method="get" action="{{ route('store-price-details') }}" >    
                                                @csrf
                                                <input type="hidden" name="formId" id="formId-1" value="{{ $form->id }}">
                                                <input type="hidden" name="tutorId" id="tutorId-1"  value="1">
                                                <input type="hidden" name="lessontype"   value="intensive">
                                                <input type="hidden" name="totalPrice" id="totalPrice-{{ $plans->admin_amount }}" value="{{$plans->admin_amount}}">
                                                <input type="hidden" name="hourss" id="hourss-{{ $plans->no_of_class }}" value="{{$plans->no_of_class}}">
                                                <button type="submit" class="btn btn-success w-100 rounded-pill">Book Now</button>
                                            </form>

                                            <!-- <div class="suitableInner mt-2">
                                                <div> <i class="fa fa-check-circle"></i></div>
                                                <div>
                                                    <p>Those who learn faster than the average person and take life in their stride, who tend to pick up new skills quicker than the average person.</p>
                                                </div>
                                            </div>

                                            <div class="suitableInner mt-2">
                                                <div> <i class="fa fa-check-circle"></i></div>
                                                <div>
                                                    <p>This is also a great course for most pupils who have had less than 10 hours of lessons and can move off and stop safely.</p>
                                                </div>
                                            </div> -->
                                        </div>    
                                    </div>

                                    <!-- <div class="col-12 bookNow">
                                        <a href="{{ url('/booknow_page1/' . $plans->id) }}" class="btn btn-warning">Book Now >></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="courseCardInner">
                            <div class="hrs">
                                <div class="digit">
                                    <span>2</span>
                                </div>
                                <div class="digit">
                                    <span>4</span>
                                </div>
                                <div class="level">
                                    <h5>24 Hours</h5>
                                    <p>Intermediate Course</p>
                                </div>
                            </div>

                            <div class="row mt-2 border-bttm">
                                <div class="col-4">
                                    <div class="depositeSec">
                                        <span>Deposit:</span> <i class="fa fa-info-circle mt-1" onclick="depositOpen();"></i>

                                    </div>
                                    <p>£549.30</p>
                                </div>
                                <div class="col-4">
                                    <span>Pay Instructor:</span>
                                    <p>£1,368.00</p>
                                </div>
                                <div class="col-4">
                                    <span>Total Price:</span>
                                    <p>£1,917.30</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="duration mt-2">
                                        <div> <i class="fa fa-calendar"></i></div>
                                        <div>
                                            <p>Typically completed over 6-9 days,
                                                saving 2 hours for test day</p>
                                        </div>
                                    </div>

                                    <div class="suitable">
                                        <p class="fw--700">This course is suitable for:</p>
                                        <div class="suitableInner mt-2">
                                            <div> <i class="fa fa-check-circle"></i></div>
                                            <div>
                                                <p>Extremely confident beginners.</p>
                                            </div>
                                        </div>

                                        <div class="suitableInner mt-2">
                                            <div> <i class="fa fa-check-circle"></i></div>
                                            <div>
                                                <p>Those who learn faster than the average person and take life in their stride, who tend to pick up new skills quicker than the average person.</p>
                                            </div>
                                        </div>

                                        <div class="suitableInner mt-2">
                                            <div> <i class="fa fa-check-circle"></i></div>
                                            <div>
                                                <p>This is also a great course for most pupils who have had less than 10 hours of lessons and can move off and stop safely.</p>
                                            </div>
                                        </div>                                  
                                    </div>    
                                </div>

                                <div class="col-12 bookNow">
                                    <a href="{{url('/booknow_page1')}}" class="btn btn-warning">Book Now >></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="courseCardInner">
                            <div class="hrs">
                                <div class="digit">
                                    <span>2</span>
                                </div>
                                <div class="digit">
                                    <span>4</span>
                                </div>
                                <div class="level">
                                    <h5>24 Hours</h5>
                                    <p>Intermediate Course</p>
                                </div>
                            </div>

                            <div class="row mt-2 border-bttm">
                                <div class="col-4">
                                    <div class="depositeSec">
                                        <span>Deposit:</span> <i class="fa fa-info-circle mt-1" onclick="depositOpen();"></i>
                                    </div>
                                    <p>£549.30</p>
                                </div>
                                <div class="col-4">
                                    <span class="fw--600 fz--14">Pay Instructor:</span>
                                    <p>£1,368.00</p>
                                </div>
                                <div class="col-4">
                                    <span class="fw--600 fs--14">Total Price:</span>
                                    <p>£1,917.30</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="duration mt-2">
                                        <div> <i class="fa fa-calendar"></i></div>
                                        <div>
                                            <p>Typically completed over 6-9 days,
                                                saving 2 hours for test day</p>
                                        </div>
                                    </div>

                                    <div class="suitable">
                                        <p class="fw--700">This course is suitable for:</p>
                                        <div class="suitableInner mt-2">
                                            <div> <i class="fa fa-check-circle"></i></div>
                                            <div>
                                                <p>Extremely confident beginners.</p>
                                            </div>
                                        </div>

                                        <div class="suitableInner mt-2">
                                            <div> <i class="fa fa-check-circle"></i></div>
                                            <div>
                                                <p>Those who learn faster than the average person and take life in their stride, who tend to pick up new skills quicker than the average person.</p>
                                            </div>
                                        </div>

                                        <div class="suitableInner mt-2">
                                            <div> <i class="fa fa-check-circle"></i></div>
                                            <div>
                                                <p>This is also a great course for most pupils who have had less than 10 hours of lessons and can move off and stop safely.</p>
                                            </div>
                                        </div>                                  
                                    </div>    
                                </div>

                                <div class="col-12 bookNow">
                                    <a href="{{url('/booknow_page1')}}" class="btn btn-warning">Book Now >></a>
                                </div>
                            </div>


                        </div>
                    </div> -->
                </div>
            @endif
        </div>
    </div>

    <script>

        function submitForm(tutorId) {
            // Ensure the hidden fields are populated before submitting
            const form = document.getElementById('bookNowForm-' + tutorId);
            const totalPrice = document.getElementById('totalPrice-' + tutorId).value;
            const hours = document.getElementById('hours-' + tutorId).value;
            if (!totalPrice) {
                alert("Please calculate the total price first.");
                return;
            }
            const hourssInput = form.querySelector('input[name="hourss"]');
                if (hourssInput) {
                    hourssInput.value = hours; // Store the hours in the hidden field
                }

            form.submit(); // Submit the form
        }
       
        function openintensive() {
            window.location.href =  "{{url('/intensive')}}";
        }
        function openweekly() {
            window.location.href =  "{{url('/advanceSearch')}}";
        }
        function fasttrackYes() {
            document.getElementById("includeOurUltimateTheory").hidden = false;
        }

        function fasttrackNo() {
            const fastTrckNo = document.getElementById("ft-no");
            if (fastTrckNo.checked) {
                document.getElementById("includeOurUltimateTheory").hidden = true;
            }
        }



        function includeFTDyes() {
            if (document.getElementById("ftd-yes").checked) {
                document.getElementById("haveUbookedDT").hidden = true;
            }
        }

        function includeFTDno() {
            document.getElementById("haveUbookedDT").hidden = false;
        }


        function haveYouBookedYes() {
            if (document.getElementById("bdt-yes").checked) {
                document.getElementById("drivingtestDate").hidden = false;
            }
        }

        function haveYouBookedNo() {
            document.getElementById("drivingtestDate").hidden = true;
        }

        // haveUbookedDT  ftd-no  ftd-yes includeFTDno includeFTDyes

        function handleOptionA() {
            const optionA = document.getElementById("flexible");
            const checkboxes = document.querySelectorAll(".toggleCheckbox");

            if (optionA.checked) {
                // If A is checked, uncheck and disable B, C, D, E
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = false;

                });
            } else {
                // If A is unchecked, enable B, C, D, E for multiple selection
                checkboxes.forEach((checkbox) => {
                    checkbox.disabled = false;
                });
            }
        }

        function handleCheckboxClick() {
            const optionA = document.getElementById("flexible");
            const checkboxes = document.querySelectorAll(".toggleCheckbox");

            // If any of B, C, D, or E is checked, uncheck A
            const anyCheckboxChecked = Array.from(checkboxes).some((checkbox) => checkbox.checked);
            if (anyCheckboxChecked) {
                optionA.checked = false;
            }
        }
    </script>


    <!-- Modal -->
    <div class="modal fade" id="fastrackInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-secondary fw--700" id="exampleModalLongTitle">Fast-Tracked Theory Test
                    </h5>
                    <button type="button" class="bg-secondary text-white close border-0" data-dismiss="modal"
                        onclick="cloze();" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>If you require a theory test, select yes and we will book you a fast tracked theory test within
                        weeks or the month of your choice.</p>
                    <p>If you include theory training as well, then the theory test will be scheduled inline with the
                        training date.</p>
                    <h3>FOR ONLY £35</h3>
                </div>
                <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cloze();">Close</button>
          
        </div> -->
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="depositModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="p-2" >
          <!-- <h5 class="modal-title fw--700" id="exampleModalLongTitle"></h5> -->
          <button type="button" style="float: right;" class="close bg-warning border-0" data-dismiss="modal" aria-label="Close" onclick="depositcloze();">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body dopisiteBody">
            <h5 class="fw--700">What is included in the Deposit?</h5>
           <div class="d-flex">
            <img src="{{url('frontendnew/img/icon/phone-call.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p class=""><b>Driving instructor finding fee</b> - This is the cost for us to communicate with instructors, we contact on average of 25 instructors via SMS, call and e-mail</p>
           </div>

           <div class="d-flex">
            <img src="{{url('frontendnew/img/icon/employees.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p><b>Our administration team costs</b> -  Covers the running of the administration side of the business while your instructor can concentrate on teaching you. This includes the new enquiry team of advisors, admin staff handling queries & our test booking team.</p>
           </div>
           <div class="d-flex">
            <img src="{{url('frontendnew/img/icon/tax-alt.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p>20% VAT is included within the deposit price</p>
           </div>
           <div class="d-flex">
            <img src="{{url('frontendnew/img/icon/car.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p><b>Automatic Instructors</b> - Automatic driving instructors charge more on average, and there are a lot fewer of them, this extra charge is within the deposit</p>
           </div>
           <div class="d-flex">
            <img src="{{url('frontendnew/img/icon/calendar-lines.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p><b>Lesson Preferences</b>- Selecting any additional lesson preferences other than flexible, costs us a lot more money to organise and therefore works out a little more within the deposit</p>

           </div>
           <div class="d-flex">
            <img src="{{url('frontendnew/img/icon/square-plus.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p><b>Additional services you book with us</b>- if you add any additional services on with your booking these are charged as part of the deposit and these include:</p>

           </div>
           
           
            <ul><li>Fast-Tracked Theory Test</li></ul>
            <ul><li>Theory Revision App</li></ul>
            <ul><li>Theory Training Workshop</li></ul>
            <ul><li>Fast-Tracked Driving Test</li></ul>
            <ul><li>Performance Coaching Videos</li></ul>
            <h5 class="fw--700">How much do I pay the driving instructor?</h5>
            <div class="d-flex">
                <img src="{{url('frontendnew/img/icon/user.png')}}" width="23px" height="23px" class="m-2" alt="">
            <p>When booking weekly lessons from 2-8 hours per week, you only have to pay the driving instructor on a pay-as-you-go basis. The hourly rate of the driving instructor is stated next to the deposit price.</p>
                
            </div>
            
        </div>
        
      </div>
    </div>
  </div>


    <script>
        function fastrackInfo() {
            $('#fastrackInfo').modal('show');
        }


        function cloze() {
            $('#fastrackInfo').modal('hide');

        }

        function depositOpen() {
            $('#depositModal').modal('show');
        }


        function depositcloze() {
            $('#depositModal').modal('hide');

        }


        
    </script>



@endsection