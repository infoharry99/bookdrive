<style>
    
    .active-btn{
      background-color: #000;
      accent-color: #fff;
      
      
    }
  
    .active-btn span{
      color: #fff;
    }
  
    .radioLogin{
      /* border-radius: 3px; */
      padding: 10px;
  
      accent-color: #000;
    }
  </style>
  
  <!-- Modal -->
  <div class="modal fade loginModel" id="loginPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered " role="document">
          <div class="modal-content loginModel">
              <div class="modal-header" style="border: none; display:flex; justify-content:end; font-size:20px">
  
                  <button type="button" class="close bg-white" data-dismiss="modal" aria-label="Close" onclick=closeLogIn(); style="border: none;">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <h3 class="text-center">Login</h3>
  
              <form class="loginForm" action="{{ url('/student-login') }}" method="GET">
                @csrf
                  <div class="form-group">
                      @if (Session::has('success'))
                                  <div class="alert alert-success">{{ Session::get('success') }}</div>
                                  <input type="hidden" id="showloginpopup" name="showloginpopup" value="0">
                              @endif
                              @if (Session::has('fail'))
                              <input type="hidden" id="showloginpopup" name="showloginpopup" value="1">
                                  <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                              @endif
                      <label for="number">Email</label>
                      <input type="text" class="form-control" id="username" name="username" aria-describedby=""
                          placeholder="Your Email" required>
                  </div>
                  <span class="text-danger  login-errorMessage">
                      @error('username')
                          {{ $message }}
                      @enderror
                  </span>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" aria-describedby=""
                          placeholder="Password" required>
                  </div>
                  <span class="text-danger login-errorMessage">
                      @error('password')
                          {{ $message }}
                      @enderror
                  </span>
                  <p class="mt-3">Login as</p>
  
                  <div class="radioBtn">
                      <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="radioLogin studentPopup  active-btn">
                                  <input type="radio" value="student" name="loginAs" id="studentPopup" checked>
                                  <span>Student</span>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="radioLogin tutorPopup">
                                  <input type="radio" value="tutor" name="loginAs" id="tutorPopup">
                                  <span>Instructor</span>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" hidden>
                              <div class="radioLogin parentsPopup">
                                  <input type="radio" value="parent" name="loginAs" id="parentsPopup">
                                  <span>Parents</span>
                              </div>
                          </div>
                      </div>
  
                      <span class="text-danger login-errorMessage">
                          @error('loginAs')
                              {{ $message }}
                          @enderror
                      </span>
                  </div>
  
                  <hr>
                  <button type="submit" class="btn brand-bg-Color mb-3">Login</button>
  
                  <br>
                  {{-- <a href="#">
                      <div class="googleLogin">
  
                          <img src="{{ url('frontendnew/img/icons/google-logo.png') }}" alt=""><span>Sign in with
                              Google</span>
  
                      </div>
  
                  </a> --}}
  
                  <div class="forgotPwd mt-3">
                      <p> Don't have an account? <a href="{{ '/student/register' }}" class="register text-warning">Register</a></p>
                      <a href="#" class="text-warning">Forgot password?</a>
                  </div>
  
  
  
  
  
  
  
              </form>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="makearequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="exampleModalLabel">Make a Request</h5>
                <button type="button" class="close bg-white" data-dismiss="modal" aria-label="Close" onclick="closeRequest();" style="border: none; font-size:20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="requestForm" class="requestForm" action="{{route('makearequest')}}" method="POST">
                @csrf
            <div class="modal-body ">
                    <!-- Full Name -->
                    <div class="form-group mb-2">
                        <label for="fullName">Full Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                    </div>
                    <!-- Mobile -->
                    <div class="form-group mb-2">
                        <label for="mobile">Mobile <span style="color: red">*</span></label>
                        <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile" required>
                    </div>
                    <!-- Email -->
                    <div class="form-group mb-2">
                        <label for="email">Email <span style="color: red">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <!-- City and Location in Single Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- City -->
                            <div class="form-group mb-2">
                                <label for="city">City <span style="color: red">*</span></label>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="" disabled selected>Select your city</option>
                                    {{-- @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Location -->
                            <div class="form-group mb-2">
                                <label for="location">Location <span style="color: red">*</span></label>
                                <select class="form-control" id="location" name="location" required>
                                    <option value="" disabled selected>Select your location</option>
                                    {{-- @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- No of Classes and Start Date in Single Row -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- No of Classes -->
                            <div class="form-group mb-2">
                                <label for="noOfClasses">No of Classes <span style="color: red">*</span></label>
                                <input type="number" class="form-control" id="noOfClasses" name="noOfClasses" placeholder="Enter number of classes" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Start Date -->
                            <div class="form-group mb-2">
                                <label for="startDate">Start Date <span style="color: red">*</span></label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>
                        </div>
                    </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeRequest();">Close</button>
                <button type="submit" class="btn brand-bg-Color" form="requestForm">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>





<script>
  function makearequest() {
      $('#makearequest').modal('show');
  }

  function closeRequest(){
    $('#makearequest').modal('hide');
  }
</script>
  
  <script>
  
  
                      document.addEventListener('DOMContentLoaded', () => {
  
                          const studentRadioPopup = document.getElementById('studentPopup');
                          const tutorRadioPopup = document.getElementById('tutorPopup');
                          const parentsRadioPopup = document.getElementById('parentsPopup');
                          const studentDivPopup = document.querySelector('.studentPopup');
                          const tutorDivPopup = document.querySelector('.tutorPopup');
                          const parentsDivPopup = document.querySelector('.parentsPopup');
  
  
                          function switchActiveClassNew() {
                          studentDivPopup .classList.remove('active-btn');
                          tutorDivPopup .classList.remove('active-btn');
                          parentsDivPopup .classList.remove('active-btn');
  
                          if (studentRadioPopup.checked) {
                              studentDivPopup .classList.add('active-btn');
                          } else if (tutorRadioPopup.checked) {
                              tutorDivPopup .classList.add('active-btn');
                          } else if (parentsRadioPopup.checked) {
                              parentsDivPopup .classList.add('active-btn');
                          }
  
                      }
                      studentRadioPopup.addEventListener('change', switchActiveClassNew);
                      tutorRadioPopup.addEventListener('change', switchActiveClassNew);
                      parentsRadioPopup.addEventListener('change', switchActiveClassNew);
  
                      });
  
  
                     
  
  
  
  
  
                  </script>
  
  
  
  <script>
      $('#myModal').on('shown.bs.modal', function() {
          $('#myInput').trigger('focus')
      })
  </script>
  <script>

    function openLogin(){
        $("#loginPopup").modal('show');
    }

    function closeLogIn(){
        $("#loginPopup").modal('hide');
    }
      $(document).ready(function(){
          if(document.getElementById('showloginpopup').value == 1){
  
              $("#loginPopup").modal('show');
          }
      });
      </script>
  
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- <a href="https://api.whatsapp.com/send?phone=+447879175585&text=Hello." class="float" target="_blank">
  <i class="fa fa-whatsapp my-float"></i>
  </a>  -->
  
  
  
  
  
  
 









    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <div class="footer-item">
                            <img src="{{url('frontendnew/img/logo2.png')}}" width="150px" alt="Logo">
                            <p class="mb-3">Welcome to 7 days Driving School Ltd ! We offer personalized, high-quality driving lessons with certified instructors, empowering students of all levels to become safe, confident, and skilled drivers.</p>
                        </div>
                        <div class="position-relative">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Enter your email">
                            <button type="button"
                                class="btn btn-secondary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Subscribe</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <a href="bd_aboutUS"><i class="fas fa-angle-right me-2"></i> About</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Cars</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Car Types</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Team</a>
                        <a href="bd_contact"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                        <a href="{{url('/termsandconditions')}}"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                        <a href="{{url('/refundpolicy')}}"><i class="fas fa-angle-right me-2"></i> Refund Policy</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Business Hours</h4>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Mon - Friday:</h6>
                            <p class="text-white mb-0">09.00 am to 07.00 pm</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Saturday:</h6>
                            <p class="text-white mb-0">10.00 am to 05.00 pm</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted mb-0">Vacation:</h6>
                            <p class="text-white mb-0">All Sunday is our vacation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <a href="#"><i class="fa fa-map-marker-alt me-2"></i> 5 Brentwick gardens Brentford TW89QL</a>
                        <a href="mailto:bookdriv@gmail.com"><i class="fas fa-envelope me-2"></i>maryan063@icloud.com </a>
                        <a href="tel:+44 20 3996 1775"><i class="fas fa-phone-alt me-2"></i>+44 7944661936</a>
                        <a href="tel:+447944661936" class="mb-3"><i class="fas fa-print me-2"></i> +447944661936</a>
                        <div class="d-flex">
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                                    class="fab fa-facebook-f text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                                    class="fab fa-twitter text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-3" href=""><i
                                    class="fab fa-instagram text-white"></i></a>
                            <a class="btn btn-secondary btn-md-square rounded-circle me-0" href=""><i
                                    class="fab fa-linkedin-in text-white"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-body"><i class="fas fa-copyright text-light"></i><a href="index.html" class="border-bottom text-white"> 7 days Driving School Ltd</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-body">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed & Developed By <a class="border-bottom text-white" href="https://thenexteck.com">Nexteck</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-warning btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('frontendnew/lib/wow/wow.min.js')}}"></script>
    <script src="{{url('frontendnew/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('frontendnew/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{url('frontendnew/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{url('frontendnew/lib/owlcarousel/owl.carousel.min.js')}}"></script>


    <!-- Template Javascript -->
    <script src="{{url('frontendnew/js/main.js')}}"></script>
</body>

</html>
  