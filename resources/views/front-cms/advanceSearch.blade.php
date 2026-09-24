@extends('front-cms.layouts.main')
@section('main-section')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container-fluid py-3 bg-secondary">
        <div class="container">
            <div class="advSearchSec">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ url('advanceSearchForm') }}" method="POST">
                    @csrf
                    
                        <!-- Hidden Inputs for Postcode and Mobile Number -->
                    <input type="hidden" name="postcode" value="{{ request()->get('postcode') }}">
                    <input type="hidden" name="mobile_number" value="{{ request()->get('mobile_number') }}">
                    <input type="hidden" name="opt_in" value="{{ request()->get('opt_in') }}">

                    <h6 class="text-white text-center fw--700">How would you like to spread out lessons</h6>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="lessonstype" id="weekly" value="weekly" {{ old('lessonstype', 'weekly') == 'weekly' ? 'checked' : '' }} />
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
                                <input type="radio" name="lessonstype" value="intensive" id="intensive" {{ old('lessonstype', 'intensive') == 'intensive' ? 'checked' : '' }}/>
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
                                        <input type="radio" name="transmission" value="manual" id="manual" {{ old('transmission', 'manual') == 'manual' ? 'checked' : '' }} />
                                        <div class="weeklyBtn">
                                            <p>Manual</p>
                                        </div>
                                    </div>
                                    @error('transmission')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="weeklyBox">
                                        <input type="radio" name="transmission" value="auto" id="auto" {{ old('transmission') == 'auto' ? 'checked' : '' }} />
                                        <div class="weeklyBtn">
                                            <p>Automatic</p>
                                        </div>
                                    </div>
                                    @error('transmission')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                        <input type="radio" name="fasttrack" value="yes" id="ft-yes" {{ old('fasttrack') == 'yes' ? 'checked' : '' }} onclick="fasttrackYes();"/>
                                        <div class="weeklyBtn">
                                            <p>Yes</p>
                                        </div>
                                    </div>
                                    @error('fasttrack')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="weeklyBox">
                                        <input type="radio" name="fasttrack" value="no" id="ft-no" {{ old('fasttrack') == 'no' ? 'checked' : '' }} onclick="fasttrackNo();"/>
                                        <div class="weeklyBtn">
                                            <p>No</p>
                                        </div>
                                    </div>
                                    @error('fasttrack')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="includeOurUltimateTheory" hidden>
                        <h6 class="text-white text-center fw--700">Would you like to include our Ultimate Theory Package?</h6>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="spreadoutLesson" value="yes" id="sol-yes" {{ old('spreadoutLesson', 'yes') == 'yes' ? 'checked' : '' }} />
                                <div class="weeklyBtn">
                                    <p>Yes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="spreadoutLesson" value="no" id="sol-no" {{ old('spreadoutLesson') == 'no' ? 'checked' : '' }} />
                                <div class="weeklyBtn">
                                    <p>No</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12" style="line-height: 10px;">
                            <h6 class="text-white text-center fw--700">Include a Fast-Tracked Driving Test <i class="fa fa-info-circle" style="cursor: pointer;" onclick="fastrackInfo();"></i></h6>
                            <p class="perfCoach" onclick="fastrackInfo();"><u>+ FREE performance coach course</u></p>
                        </div>

                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="fasttrackdriving" value="yes" id="ftd-yes" {{ old('fasttrackdriving') == 'yes' ? 'checked' : '' }} onclick="includeFTDyes()" />
                                <div class="weeklyBtn">
                                    <p>Yes</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="fasttrackdriving" value="no" id="ftd-no" {{ old('fasttrackdriving') == 'no' ? 'checked' : '' }} onclick="includeFTDno()" />
                                <div class="weeklyBtn">
                                    <p>No</p>
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
                                <input type="radio" name="" value="yes" id="bdt-yes" {{ old('bookedDrivingtest') == 'yes' ? 'checked' : '' }} onclick="haveYouBookedYes();" />
                                <div class="weeklyBtn">
                                    <p>Yes</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="bookedDrivingtest" value="no" id="bdt-no" {{ old('bookedDrivingtest') == 'no' ? 'checked' : '' }} onclick="haveYouBookedNo();" />
                                <div class="weeklyBtn">
                                    <p>No</p>bookedDrivingtest
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="drivingtestDate" hidden>
                        <div class="col-12">
                            <div class="text-center mb-2" style="line-height: 10px;">
                                <h6 class="text-white text-center fw--700">What date is your driving test?</h6>
                                <i class="text-white text-center">We cannot fit in tests less than 10 days away</i>
                                <input type="date" name="drivingtestDate" class="form-control mt-2" value="{{ old('drivingtestDate') }}">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-2" style="line-height: 10px;">
                        <h6 class="text-white text-center fw--700">Lesson Preferences</h6>
                        <i class="text-white text-center">Select all that apply</i>
                    </div>
                    <div class="flex-container mb-2">
                        <div class="flex-item weeklyBox">
                            <input type="radio" name="lesson-time" value="flexible" id="flexible" {{ old('lesson-time') == 'flexible' ? 'checked' : '' }} onclick="handleOptionA()" />
                            <div class="weeklyBtn2 pad-20-5">
                                <p>Flexible</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" name="lesson-time" value="weekly-morning" id="weekly-morning" {{ old('lesson-time') == 'weekly-morning' ? 'checked' : '' }} onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-10-5">
                                <p>Weekday Mornings</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" name="lesson-time"  value="weekly-afternoon" id="weekly-afternoon" {{ old('lesson-time') == 'weekly-afternoon' ? 'checked' : '' }} onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-10-5">
                                <p>Weekday Afternoon</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox" name="lesson-time"  value="weekly-evening" id="weekly-evening" {{ old('lesson-time') == 'weekly-evening' ? 'checked' : '' }} onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-10-5">
                                <p>Weeklday Evening</p>
                            </div>
                        </div>
                        <div class="flex-item weeklyBox">
                            <input type="radio" class="toggleCheckbox"  name="lesson-time"   value="weekend" id="weekend" {{ old('lesson-time') == 'weekend' ? 'checked' : '' }} onclick="handleCheckboxClick()" />
                            <div class="weeklyBtn2 pad-20-5">
                                <p>Weekend</p>
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


                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> SEARCH</button>
                </form>
            </div>
        </div>
    </div>
    @if(isset($admin) && $admin == 1)
        <?php 
        $intensive_plans = DB::table('intensive_plans')->get();
        ?>
        <div class="row mt-4">
            @foreach($intensive_plans as $plans )
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="courseCardInner">
                        <div class="hrs">
                            <!-- <div class="digit">
                                <span>2</span>
                            </div> -->
                            <!-- <div class="digit">
                               <span>{{$plans->no_of_class}}</span>
                            </div> -->
                            <div class="level">
                                <h5>No of Hours:- {{$plans->no_of_class}}</h5>
                                 <p>{{$plans->detail}}</p>
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
                                <!-- <div class="duration mt-2">
                                   <div> <i class="fa fa-calendar"></i></div>
                                    <div>
                                        <p>No of Classes:-  {{$plans->no_of_class}}</p>
                                    </div>
                                </div> -->
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
                                        <input type="hidden" name="planId" id="planId-1" value="{{ $plans->id }}">
                                        <input type="hidden" name="tutorId" id="tutorId-1"  value="1">
                                        <input type="hidden" name="lessontype"   value="intensive">
                                        <input type="hidden" name="totalPrice" id="totalPrice-{{ $plans->rate }}" value="{{$plans->rate}}">
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
                <br><br><br><br>
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
    @elseif (isset($tutors) && $tutors->isNotEmpty())
        <div class="row mt-4">
            
            @foreach ($tutors as $tutor)
                 @php
                    $avg = $tutor->average_rating ?? 0;
                    $fullStars = floor($avg);
                    $halfStar = $avg - $fullStars >= 0.5;
                @endphp
               <div class="modal fade" id="profileModal-{{ $tutor->tutor_id }}" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel-{{ $tutor->tutor_id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-lg">
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="profileModalLabel-{{ $tutor->tutor_id }}">Tutor Profile: {{ $tutor->name }}</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p><strong>Subject:</strong> {{ $tutor->subject_name }}</p>
                        <p><strong>Rating:</strong> {{ $tutor->average_rating ?? 'No ratings yet' }}</p>
                        <p><strong>Rate (1-4 classes):</strong> ${{ $tutor->rateperhour }}</p>
                        <p><strong>Rate (5-9 classes):</strong> ${{ $tutor->rateperhour2 }}</p>
                        <p><strong>Rate (10+ classes):</strong> ${{ $tutor->rateperhour3 }}</p>
                        <!-- You can add more info like experience, description, etc. -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4"> 
                    <div class="card shadow-lg rounded-lg">
                        <div class="card-header text-center bg-primary text-white rounded-top">
                            <span class="font-weight-bold" style="font-size: 1.2rem;">{{ $tutor->subject_name }}</span>
                        </div>

                        <div class="card-body">
                            <!-- Tutor Name and Icon -->
                            <div class="d-flex flex-column align-items-center mb-4">
                                <i class="fas fa-chalkboard-teacher text-primary" style="font-size: 70px; margin-bottom: 15px;"></i>
                                <h5 class="card-title text-dark" style="font-size: 1.4rem; font-weight: bold;">{{ $tutor->name }}</h5>
                            <!--     <button -->
                            <!--    class="btn btn-outline-info btn-sm mt-2" -->
                            <!--    data-toggle="modal" -->
                            <!--    data-target="#profileModal-{{ $tutor->tutor_id }}">-->
                            <!--    View Profile-->
                            <!--</button>-->
                            </div>
                           
                            <div class="mb-4">
                                <div class="rate-info">
                                    <p><i class="fas fa-clock text-success"></i> <strong>Rate per Hour (for 1-4 classes):</strong> <span class="text-success">${{ $tutor->rateperhour }}</span></p>
                                    <p><i class="fas fa-book text-warning"></i> <strong>Rate per Hour (for 5-9 classes):</strong> <span class="text-warning">${{ $tutor->rateperhour2 }}</span></p>
                                    <p><i class="fas fa-graduation-cap text-danger"></i> <strong>Rate per Hour (for more than 9 classes):</strong> <span class="text-danger">${{ $tutor->rateperhour3 }}</span></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center text-yellow-500" >
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullStars)
                                        <i class="fas fa-star" style="color: gold;"></i>
                                    @elseif ($i == $fullStars + 1 && $halfStar)
                                        <i class="fas fa-star-half-alt" style="color: gold;"></i>
                                    @else
                                        <i class="far fa-star" style="color: gold;"></i>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm text-grey-600">
                                    {{ $avg > 0 ? number_format($avg, 1) : 'No ratings yet' }}
                                </span>
                            </div>
                            <br><br>
                            
                            <input type="hidden" name="formId" value="{{ $form->id }}">
                            <div class="alert alert-info text-center rounded-3" role="alert">
                                <strong>Test Booking Included:</strong> Book your session today!
                            </div>

                            <!-- Input field for hours -->
                            <div class="form-group">
                                <label for="hours-{{ $tutor->tutor_id }}" class="text-muted">Enter Hours:</label>
                                <input type="number" class="form-control rounded-pill" id="hours-{{ $tutor->tutor_id }}" name="hourss" placeholder="Enter hours" min="1">
                            </div>
                            
                            <button type="button" class="btn btn-primary w-100 rounded-pill mb-3" onclick="calculateTotalPrice('{{ $tutor->tutor_id }}', '{{ $tutor->rateperhour }}', '{{ $tutor->rateperhour2 }}', '{{ $tutor->rateperhour3 }}')">Calculate Price</button>

                            <p class="mt-2 text-center">
                                <strong>Total Price:</strong> $<span id="total-price-{{ $tutor->tutor_id }}">0</span>
                            </p>

                            <!-- Should You Complete All 4 Hours? -->
                            <p class="text-center mt-2 text-muted"><em>Should you complete all 4 hours, the total price will be as shown above.</em></p>
                            <form id="bookNowForm-{{ $tutor->tutor_id }}" method="get" action="{{ route('store-price-details') }}" >    
                            @csrf
                                <input type="hidden" name="formId" id="formId-{{ $tutor->tutor_id }}" value="{{ $form->id }}">
                                <input type="hidden" name="tutorId" id="tutorId-{{ $tutor->tutor_id }}">
                                <input type="hidden" name="totalPrice" id="totalPrice-{{ $tutor->tutor_id }}">
                                <input type="hidden" name="hourss" id="hourss-{{ $tutor->tutor_id }}">
                                <button type="button" class="btn btn-success w-100 rounded-pill" onclick="submitForm('{{ $tutor->tutor_id }}')">Book Now</button>
                            </form>
                        </div>
                        
                        <div class="card-footer text-center bg-light rounded-bottom">
                            <div class="d-flex justify-content-around">
                                <div><i class="fas fa-calendar-alt text-info"></i> <span>Available for Weekend Classes</span></div>
                                <div><i class="fas fa-clock text-warning"></i> <span>1-2 Hours per Session</span></div>
                                <div><i class="fas fa-comments text-danger"></i> <span>Interactive Sessions</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-center">No tutors found for this postcode.</p>
    @endif

    <script>
        
        function calculateTotalPrice(tutorId, rate1, rate2, rate3) {
            const hours = document.getElementById(`hours-${tutorId}`).value;
            
            if (hours) {
                let rate;
                
                // Determine the rate based on the number of hours
                if (hours >= 1 && hours <= 4) {
                    rate = parseFloat(rate1); // Rate for 1-4 classes
                } else if (hours >= 5 && hours <= 9) {
                    rate = parseFloat(rate2); // Rate for 5-9 classes
                } else if (hours >= 10) {
                    rate = parseFloat(rate3); // Rate for more than 9 classes
                }
                
            
                const totalPrice = hours * rate;
                
            
        
            // document.getElementById('bookNowForm').submit();
            document.getElementById(`total-price-${tutorId}`).innerText = totalPrice.toFixed(2);

            // Update hidden fields for form submission
            document.getElementById(`totalPrice-${tutorId}`).value = totalPrice.toFixed(2);
            document.getElementById(`tutorId-${tutorId}`).value = tutorId;
            document.getElementById(`formId-${tutorId}`).value = document.getElementById(`formId-${tutorId}`).value;
            document.getElementById(`hourss-${tutorId}`).value = hours;

            } else {
                alert("Please enter the number of hours.");
            }
        }

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

    </script>

    <style>
        /* Additional Styling */
        .rate-info p {
            font-size: 1.1rem;
            margin: 10px 0;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .rate-info span {
            font-weight: bold;
            margin-left: 10px;
        }

        .rate-info i {
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .card-header {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            font-size: 1.3rem;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 25px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .rate-info p:hover {
            background-color: #f1f1f1;
            cursor: pointer;
            padding-left: 15px;
            transition: padding-left 0.3s ease;
        }

        .rate-info i:hover {
            color: #ff5733;
            transition: color 0.3s ease;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 20px;
            font-size: 1rem;
        }

        .card-footer div {
            display: flex;
            align-items: center;
        }

        .card-footer i {
            font-size: 1.5rem;
            margin-right: 8px;
        }

        .card-footer span {
            font-size: 1rem;
            font-weight: 500;
        }

        .card-footer .d-flex {
            justify-content: space-around;
        }

        /* Rounded buttons */
        .btn-rounded {
            border-radius: 50px;
        }

        /* Hover effects for cards */
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
    </style>

    <script>

        function openintensive() {
            window.location.href =  "{{url('/intensive')}}";
        }

        function fasttrackYes() {
            document.getElementById("includeOurUltimateTheory").hidden = false;
        }

        function fasttrackNo() {
            const fastTrckNo = document.getElementById("ft-no");
            if (fastTrckNo.checked) {
                document.getElementById("includeOurUltimateTheory").hidden=true;
            }  
        }

       

        function includeFTDyes() {
            if (document.getElementById("ftd-yes").checked) {
                document.getElementById("haveUbookedDT").hidden=true;
            }  
        }

        function includeFTDno() {
            document.getElementById("haveUbookedDT").hidden = false;
        }


        function haveYouBookedYes() {
           if (document.getElementById("bdt-yes").checked) {  
               document.getElementById("drivingtestDate").hidden=false;
           }  
       }

       function haveYouBookedNo() {
           document.getElementById("drivingtestDate").hidden= true;
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
    </script>

@endsection