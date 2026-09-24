@extends('front-cms.layouts.main')
@section('main-section')

<style>
#passwordField {
    transition: all 0.3s ease-in-out;
}


</style>
    <div class="container-fluid py-3 bg-secondary">
        <div class="container">
            <div class="bookSum">
                <form action="{{ route('sumbookings.store') }}" method="post">
                     @csrf 
                    <h6 class="text-white text-center fw--700"><u>Booking Summary</u>
                    </h6>
                    <div class="topSec">
                        <div class="checkboxes">
                            <span><input type="checkbox" checked disabled><label for="">&nbsp; Vehicle</label></span>
                            <span><input type="checkbox" checked disabled><label for="">&nbsp; Theory test to be booked by
                                    us</label></span>
                            <span><input type="checkbox" checked disabled><label for="">&nbsp; Hours of Lessons</label></span>
                            <span><input type="checkbox" checked disabled><label for="">&nbsp; Lessons</label></span>
                        </div>

                         <input type="hidden" name="finalform_id" value="{{ old('finalform_id', $finalId ?? null) }}">
                        <input type="hidden" name="optid" value="{{ old('optid', $optid ?? null) }}">

                        <div class="row top3input">

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                                <div>
                                    <p><b>When would you like to start?</b></p>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                                <div>
                                    
                                    <p><b>Theroy certificate number</b></p>
                                    <input type="text" class="form-control" name="certificate_number" placeholder="Input certificate number" >
                                    
                                    
                                    <!--<select class="form-control" name="theory_test_date" >-->
                                    <!--    <option value="ASAP(usaually within 4 week)">ASAP(usaually within 4 week)</option>-->
                                    <!--</select>-->
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                                <div>
                                    <p><b>Prefered test center</b></p>
                                    <input type="text" class="form-control" name="prefered_test_center" placeholder="Input Prefered Test center" >
                                    <!--<select class="form-control" name="practical_test_date" >-->
                                    <!--    <option value="ASAP after passing theory test">ASAP after passing theory test</option>-->
                                    <!--</select>-->
                                </div>

                            </div>

                        </div>
                            
                         <div class="row top3input">

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                                <div>
                                    <p><b>When Pass Therory Certificate?</b></p>
                                    <input type="date" class="form-control" name="pass_theory" required>
                                </div>
                            </div>
                        </div>
                        <!--<h6 class="text-white text-center fw--700"><u>A Few More Details</u>-->
                        <!--</h6>-->
                    </div>

                   <div class="seconSec">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>First & Middle Names (line 1 on your licence)</b></label>
                            <input type="text" class="form-control" name="first_name" placeholder="Input First Name" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>Surname (line 2 on your licence)</b></label>
                            <input type="text" name="surname" class="form-control" placeholder="Input surname" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>Date of Birth (line 3 on your licence)</b></label>
                            <input type="date" class="form-control" placeholder="" name="dob" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>Contact No:</b></label>
                            <input type="number" class="form-control" name="contact_no" placeholder="Input Contact No." required>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                              <label for=""><b>Licence Number (line 5 on your licence)</b></label>
                            <input type="text" class="form-control" name="licence" placeholder="Input licence" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>Theroy number</b></label>
                            <input type="text" name="theroy" class="form-control" placeholder="Input theroy" required>
                        </div>
                    </div>

                  

                    <div class="row">
                        <div class="col-12">
                            <label for=""><b>E-mail Address</b></label>
                            <input type="text" class="form-control" name="email" id="email" required>
                              <span id="emailAlert" class="text-danger" style="display: none;">This email is already registered.</span>
                        </div>

                        <!--<div class="col-12">-->
                        <!--    <label for=""><b>Address</b></label>-->
                        <!--    <select type="text" class="form-control">-->
                        <!--        <option value=""></option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                            <label for=""><b>Address Line 1</b></label>
                            <input type="text" class="form-control" name="address_line1" required>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                            <label for=""><b>Address Line 2</b></label>
                            <input type="text" class="form-control" name="address_line2" required>

                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                            <label for=""><b>Postcode</b></label>
                            <input type="text" class="form-control" name="address_line3" required>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>Driving Experience</b></label>
                            <select type="text" class="form-control" name="driving_experience" placeholder="Input First Name" required>
                                <option value="I can drive or I have been in for a driving test">I can drive or I have been in for a driving test</option>
                                <option value="I have had 30 or more driving lessons">I have had 30 or more driving lessons</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-2">
                            <label><b>How did you here about us?</b></label>
                            <select type="text" class="form-control" name="how_heard_about_us" placeholder="Input First Name" required>
                                <option value="How did you hear about us?">How did you hear about us?</option>
                                <option value="Google">Google</option>
                                <option value="tiktok">TikTok </option>
                                <option value="facebook">Facebook </option>
                                <option value="instagram">Instagram </option>
                                <option value="from_friend_or_family">From friend or family </option>
                                <option value="word_of_mouth">Word of mouth</option>
                            </select>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-2">
                            <label><b>Have you been ordered by court to take an extended test? (+£62)</b></label>
                            <select type="text" class="form-control" name="extended_test" placeholder="Input First Name" required>
                                <option value="No, I do not require an extended test">No, I do not require an extended test</option>
                                <option value="Yes, I require an extended test as advised by the court (+£62)">Yes, I require an extended test as advised by the court (+£62)</option>
                            </select>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-2" id="passwordField" required>
                            <label for="" ><b>For Register Password</b></label>
                            <input type="text" class="form-control"  name="password" id="password">

                        </div>
                    </div>
                    <!--<div class="promo">-->
                    <!--    <label for="">Discount Code</label>-->
                    <!--    <div>-->
                    <!--        <input type="text">-->
                    <!--        <button>Apply</button>-->
                    <!--    </div>-->
                    <!--</div>-->

                    
                    <!--<div class="bg-white p-3 my-4 bottonSec">-->
                    <!--    <div class="row text-center">-->
                    <!--        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
                    <!--            <h5><u>Deposit:</u></h5>-->
                    <!--        </div>-->
                    <!--        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
                    <!--            <h5><u>Pay the Instructor:</u></h5>-->
                    <!--            <h5 class="fw--700 text-dark">£0.00</h5>-->
                    <!--        </div>-->
                    <!--        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
                    <!--            <h5><u>Total Price:</u></h5>-->
                    <!--            <h5 class="fw--700 text-dark">£0.00</h5>-->
                    <!--        </div>-->
                    <!--        <div class="col-12">-->
                    <!--            <span class="text-center fs--14 ">Pay only the deposit now</span>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="checkbox" id="termsCheckbox">
                            <label for="termsCheckbox">I accept and Read  
                                <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal"> Policy & Terms and Conditions</a>
                            </label>
                        </div>

                        <div class="col-12 bookNow">
                            <button type="submit" class="btn btn-warning" id="submitBtn" disabled>NEXT</button>
                        </div>
                    </div>

                   </div>

                </form>
            </div>
        </div>
    </div>


<!-- Terms and Conditions Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <ol>
          <li><strong>Booking and Payment</strong>
            <ul>
              <li>All bookings must be made through our official website.</li>
              <li>A deposit is required at the time of booking. Full payment must be made prior to the start of the lessons unless otherwise agreed.</li>
              <li>Payments are non-transferable and must be made in the name of the learner.</li>
              <li>Prices listed on the website are inclusive of applicable taxes unless stated otherwise.</li>
            </ul>
          </li>
          <li><strong>Cancellations and Refunds</strong>
            <ul>
              <li>If you wish to cancel your booking, you must do so at least 48 hours in advance.</li>
              <li>Cancellations made within 48 hours may result in forfeiture of the lesson fee or deposit.</li>
              <li>Refunds, if applicable, will be processed within 7–10 working days.</li>
              <li>We reserve the right to cancel or reschedule lessons due to instructor availability or unforeseen circumstances.</li>
            </ul>
          </li>
          <li><strong>Learner Requirements</strong>
            <ul>
              <li>All learners must possess a valid provisional or full UK driving licence.</li>
              <li>You must bring your licence to every lesson. Failure to do so may result in lesson cancellation.</li>
              <li>It is your responsibility to inform us of any medical conditions or medication that may affect your ability to drive.</li>
            </ul>
          </li>
          <li><strong>Instructor and Vehicle Use</strong>
            <ul>
              <li>All instructors provided through the platform are DVSA-approved.</li>
              <li>Vehicles are insured and meet DVSA safety standards.</li>
              <li>No smoking or eating is allowed in the training vehicle.</li>
            </ul>
          </li>
          <li><strong>Theory and Practical Tests</strong>
            <ul>
              <li>If selected, we will book theory and/or practical tests on your behalf.</li>
              <li>We are not responsible for test cancellations made by DVSA.</li>
              <li>You are responsible for arriving at the test centre on time with necessary documents.</li>
            </ul>
          </li>
          <li><strong>Extended Tests and Legal Orders</strong>
            <ul>
              <li>Disclose court-ordered extended tests during booking.</li>
              <li>Additional charges apply for extended tests.</li>
            </ul>
          </li>
          <li><strong>Liability and Conduct</strong>
            <ul>
              <li>We are not liable for incidents caused by your negligence.</li>
              <li>Abusive behaviour may lead to termination of service.</li>
              <li>Vehicle damage due to misuse may be chargeable.</li>
            </ul>
          </li>
          <li><strong>Data and Privacy</strong>
            <ul>
              <li>We comply with GDPR. Your data is secure.</li>
              <li>No data is shared with third parties without consent.</li>
            </ul>
          </li>
          <li><strong>Modifications</strong>
            <ul>
              <li>Terms may change at any time. Refer to the latest version on our website.</li>
            </ul>
          </li>
          <li><strong>Agreement</strong>
            <ul>
              <li>By continuing, you confirm you have read and accepted these terms.</li>
            </ul>
          </li>
          <li><strong>Agreement</strong>
            <ul>
              <li>To get you a booking date that suits you we will use your details to hold booking date so you will a desire date for driving test</li>
            </ul>
          </li>
        </ol>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('termsCheckbox');
        const button = document.getElementById('submitBtn');

        checkbox.addEventListener('change', function () {
            button.disabled = !this.checked;
        });
    });
</script>
    <script>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#email').on('blur', function () {
        const email = $(this).val();

        if (email) {
            $.ajax({
                url: '{{ route('check.email') }}', // Route to the controller
                method: 'POST',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function (response) {
                    if (response.exists) {
                        // Show alert, clear input, and hide password field
                        $('#emailAlert').text('This email is already registered.').show();
                       // $('#email').val(''); // Clear the input
                        // $('#passwordField').hide(); // Hide password field
                    } else {
                        // Hide alert and show password field
                        $('#emailAlert').hide();
                        $('#passwordField').show();
                    }
                },
                error: function () {
                    alert('An error occurred while checking the email.');
                     event.preventDefault();
                }
            });
        }
    });
});
</script>



@endsection