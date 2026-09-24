@extends('front-cms.layouts.main')
@section('main-section')
<div class="container-fluid py-3 bg-secondary">
        <div class="container">
            <div class="advSearchSec">
                <form action="">
                    <h6 class="text-white text-center fw--700">Have you passed your theory test?
            
                    </h6>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="passed" id="pass-yes" onclick="passedtheotyYes();" />
                                <div class="weeklyBtn">
                                    <p class="">Yes</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="passed" id="pass-no" onclick="passedtheotyNo();" />
                                <div class="weeklyBtn">
                                    <p class="">No</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="testpasiingdate" hidden>
                        <div class="col-12">
                            <div class="text-center mb-2" style="line-height: 10px;">
                                <h6 class="text-white text-center fw--700">Roughly what date did you pass your theory
                                    test?</h6>
                                <input type="date" class="form-control mt-2">
                            </div>
                        </div>
                    </div>

                    <div class="row" hidden id="areYouSure">
                        <div class="col-12">
                            <div class="text-center mb-2" style="line-height: 10px;">
                                <h6 class="text-white text-center fw--700">Are you sure you do not want us to book you a
                                    quicker theory test?</h6>
                                <p class="fs--14"><span class="fw--700 text-warning">£5 OFF</span>   &nbsp;&nbsp;&nbsp;  <del class="text-white">RRP £40  </del>  &nbsp;&nbsp;&nbsp; <span class="fw--700 text-white">NOW £35</span></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="discount" id="discounted" onclick="getdiscount();" />
                                <div class="weeklyBtn">
                                    <p class="">Add Discounted Test</p> 

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="discount" id="nothanks" onclick="noThanks();" />
                                <div class="weeklyBtn">
                                    <p class="">No Thanks</p>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row" id="onlinezoomClass" hidden >
                        <div class="col-12">
                            <div class="text-center mb-2" style="line-height: 10px;">
                                <h6 class="text-white text-center fw--700">Increase your chances of passing your theory test with an online zoom theory training course?</h6>
                                <i class="fa fa-info-circle text-white" style="cursor: pointer;" onclick="zoomInfo();"></i>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="onlinezoom" id="zoomclass-yes"  onclick="zoomClassYes();"/>
                                <div class="weeklyBtn">
                                    <p class="">Yes (+ &pound;30)</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="onlinezoom" id="zoomclass-no" onclick="zoomClassNo();" />
                                <div class="weeklyBtn">
                                    <p class="">No</p>

                                </div>
                            </div>
                        </div>

                    </div>

                    
                    
                    <div class="row" id="subscribeSec" hidden >
                        <div class="col-12">
                            <div class="text-center mb-2" style="line-height: 10px;">
                                <h6 class="text-white text-center fw--700">Subscribe to the best theory revision app?</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="subscribe" id="subscribe-yes" />
                                <div class="weeklyBtn">
                                    <p class="">Yes</p>
                                    <small>(+&pound; per month)</small>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <div class="weeklyBox">
                                <input type="radio" name="subscribe" id="subscribe-no"  />
                                <div class="weeklyBtn">
                                    <p class="">No</p>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 bookNow">
                        <a href="{{url('/bookingsummary')}}" class="btn btn-warning">NEXT</a>
                    </div>
                </form>
            </div>



        </div>
    </div>


    <div class="modal fade" id="zoomInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <img src="img/icon/phone-call.png" width="23px" height="23px" class="m-2" alt="">
                <p class=""><b>Driving instructor finding fee</b> - This is the cost for us to communicate with instructors, we contact on average of 25 instructors via SMS, call and e-mail</p>
               </div>
    
               <div class="d-flex">
                <img src="img/icon/employees.png" width="23px" height="23px" class="m-2" alt="">
                <p><b>Our administration team costs</b> -  Covers the running of the administration side of the business while your instructor can concentrate on teaching you. This includes the new enquiry team of advisors, admin staff handling queries & our test booking team.</p>
               </div>
               <div class="d-flex">
                <img src="img/icon/tax-alt.png" width="23px" height="23px" class="m-2" alt="">
                <p>20% VAT is included within the deposit price</p>
               </div>
               <div class="d-flex">
                <img src="img/icon/car.png" width="23px" height="23px" class="m-2" alt="">
                <p><b>Automatic Instructors</b> - Automatic driving instructors charge more on average, and there are a lot fewer of them, this extra charge is within the deposit</p>
               </div>
               <div class="d-flex">
                <img src="img/icon/calendar-lines.png" width="23px" height="23px" class="m-2" alt="">
                <p><b>Lesson Preferences</b>- Selecting any additional lesson preferences other than flexible, costs us a lot more money to organise and therefore works out a little more within the deposit</p>
    
               </div>
               <div class="d-flex">
                <img src="img/icon/square-plus.png" width="23px" height="23px" class="m-2" alt="">
                <p><b>Additional services you book with us</b>- if you add any additional services on with your booking these are charged as part of the deposit and these include:</p>
    
               </div>
               
               
                <ul><li>Fast-Tracked Theory Test</li></ul>
                <ul><li>Theory Revision App</li></ul>
                <ul><li>Theory Training Workshop</li></ul>
                <ul><li>Fast-Tracked Driving Test</li></ul>
                <ul><li>Performance Coaching Videos</li></ul>
                <h5 class="fw--700">How much do I pay the driving instructor?</h5>
                <div class="d-flex">
                    <img src="img/icon/user.png" width="23px" height="23px" class="m-2" alt="">
                <p>When booking weekly lessons from 2-8 hours per week, you only have to pay the driving instructor on a pay-as-you-go basis. The hourly rate of the driving instructor is stated next to the deposit price.</p>
                    
                </div>
                
            </div>
            
          </div>
        </div>
      </div>

    <script>

       

        function passedtheotyYes() {
            document.getElementById("testpasiingdate").hidden = false;
            document.getElementById("areYouSure").hidden = true;
            document.getElementById("onlinezoomClass").hidden = true;
            document.getElementById("subscribeSec").hidden = true;
           
        }

        function passedtheotyNo() {
            const fastTrckNo = document.getElementById("pass-no");
            if (fastTrckNo.checked) {
                document.getElementById("testpasiingdate").hidden = true;
                document.getElementById("areYouSure").hidden = false;
            }
        }


         
        function getdiscount() {
            document.getElementById("onlinezoomClass").hidden = false;
            // document.getElementById("areYouSure").hidden = true;
        }

        function noThanks() {
            document.getElementById("onlinezoomClass").hidden = false;
        }


        function zoomClassYes() {
            document.getElementById("subscribeSec").hidden = false;
            // document.getElementById("areYouSure").hidden = true;
        }

        function zoomClassNo() {
            document.getElementById("subscribeSec").hidden = false;
        }
        

       
       

         function zoomInfo() {
            $('#zoomInfo').modal('show');
        }


        function cloze() {
            $('#zoomInfo').modal('hide');

        }
      









        

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


@endsection