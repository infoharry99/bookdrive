@extends('admin.layouts.main')
@section('main-section')


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                   
                  


                   
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-animate">
                        <div class="cardTitle">
                            <h5>Schedule Classes</h5>
                        
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Mobile Number</th>
            <th>Postcode</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($forms as $form)
            <tr>
                 <td>{{ $form->id }}</td>
                <td>{{ $form->mobile_number }}</td>
                <td>{{ $form->postcode }}</td>
                <td>
                   <button class="btn btn-info" onclick="openModal({{ $form->id }})">View</button>
               
                </td>
            </tr>
            <!-- Hidden details row -->
            <tr id="details-{{ $form->id }}" class="details-row" style="display:none;">
                <td colspan="3">
                    <p><strong>Lesson Type:</strong> {{ $form->lessonstype }}</p>
                    <p><strong>Transmission:</strong> {{ $form->transmission }}</p>
                    <p><strong>Fasttrack:</strong> {{ $form->fasttrack }}</p>
                    <p><strong>Spread Out Lesson:</strong> {{ $form->spreadoutLesson }}</p>
                    <p><strong>Fast Track Driving:</strong> {{ $form->fasttrackdriving }}</p>
                    <p><strong>Booked Driving Test:</strong> {{ $form->bookedDrivingtest }}</p>
                    <p><strong>Driving Test Date:</strong> {{ $form->drivingtestDate }}</p>
                    <p><strong>Lesson Time:</strong> {{ $form->lessonTime }}</p>
                    <p><strong>Previous Experience:</strong> {{ $form->previous_experience }}</p>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



                            </div>


                        </div>
                    </div>
                </div>

               
            </div> <!-- end row-->

<div class="modal fade" id="formDetailsModal" tabindex="-1" aria-labelledby="formDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formDetailsModalLabel">Form Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Basic Information Table -->
        <h6 class="text-primary">Basic Information</h6>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>First Name</th>
              <td id="first_name"></td>
            </tr>
            <tr>
              <th>Surname</th>
              <td id="surname"></td>
            </tr>
            <tr>
              <th>Date of Birth</th>
              <td id="dob"></td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td id="contact_no"></td>
            </tr>
            <tr>
              <th>Email</th>
              <td id="email"></td>
            </tr>
            <tr>
              <th>Address</th>
              <td id="address"></td>
            </tr>
          </tbody>
        </table>

        <!-- Lesson Details Table -->
        <h6 class="text-primary">Lesson Details</h6>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Lesson Type</th>
              <td id="lessonstype"></td>
            </tr>
            <tr>
              <th>Transmission</th>
              <td id="transmission"></td>
            </tr>
            <tr>
              <th>Fast Track</th>
              <td id="fasttrack"></td>
            </tr>
            <tr>
              <th>Spread Out Lesson</th>
              <td id="spreadoutLesson"></td>
            </tr>
            <tr>
              <th>Fast Track Driving</th>
              <td id="fasttrackdriving"></td>
            </tr>
            <tr>
              <th>Driving Test Booked</th>
              <td id="bookedDrivingtest"></td>
            </tr>
            <tr>
              <th>Driving Test Date</th>
              <td id="drivingtestDate"></td>
            </tr>
            <tr>
              <th>Lesson Time</th>
              <td id="lessonTime"></td>
            </tr>
            <tr>
              <th>Previous Experience</th>
              <td id="previous_experience"></td>
            </tr>
          </tbody>
        </table>

        <!-- Additional Information Table -->
        <h6 class="text-primary">Additional Information</h6>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Passed Theory</th>
              <td id="passed_theory"></td>
            </tr>
            <tr>
              <th>Theory Test Date</th>
              <td id="theory_test_date"></td>
            </tr>
            <tr>
              <th>Practical Test Date</th>
              <td id="practical_test_date"></td>
            </tr>
            <tr>
              <th>Book Quicker Theory</th>
              <td id="book_quicker_theory"></td>
            </tr>
            <tr>
              <th>Zoom Training</th>
              <td id="zoom_training"></td>
            </tr>
            <tr>
              <th>Revision App</th>
              <td id="revision_app"></td>
            </tr>
            <tr>
              <th>Total Price</th>
              <td id="total_price"></td>
            </tr>
          </tbody>
        </table>

        <!-- Other Details Table -->
        <h6 class="text-primary">Other Details</h6>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Driving Experience</th>
              <td id="driving_experience"></td>
            </tr>
            <tr>
              <th>How Heard About Us</th>
              <td id="how_heard_about_us"></td>
            </tr>
            <tr>
              <th>Extended Test</th>
              <td id="extended_test"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
    
      </div>
    </div>
  </div>
</div>

                </div>
                <!-- container-fluid -->
            </div>
            
            <!-- End Page-content -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openModal(formId) {
        let form = @json($forms->toArray()).find(f => f.id === formId);

        // Basic Information
        document.getElementById('first_name').innerText = form.first_name;
        document.getElementById('surname').innerText = form.surname;
        document.getElementById('dob').innerText = form.dob;
        document.getElementById('contact_no').innerText = form.contact_no;
        document.getElementById('email').innerText = form.email;
        document.getElementById('address').innerText = [form.address_line1, form.address_line2, form.address_line3].filter(Boolean).join(', ');

        // Lesson Details
        document.getElementById('lessonstype').innerText = form.lessonstype;
        document.getElementById('transmission').innerText = form.transmission;
        document.getElementById('fasttrack').innerText = form.fasttrack;
        document.getElementById('spreadoutLesson').innerText = form.spreadoutLesson;
        document.getElementById('fasttrackdriving').innerText = form.fasttrackdriving;
        document.getElementById('bookedDrivingtest').innerText = form.bookedDrivingtest;
        document.getElementById('drivingtestDate').innerText = form.drivingtestDate;
        document.getElementById('lessonTime').innerText = form.lessonTime;
        document.getElementById('previous_experience').innerText = form.previous_experience;

        // Additional Information
        document.getElementById('passed_theory').innerText = form.passed_theory;
        document.getElementById('theory_test_date').innerText = form.theory_test_date;
        document.getElementById('practical_test_date').innerText = form.practical_test_date;
        document.getElementById('book_quicker_theory').innerText = form.book_quicker_theory;
        document.getElementById('zoom_training').innerText = form.zoom_training;
        document.getElementById('revision_app').innerText = form.revision_app;
        document.getElementById('total_price').innerText = form.total_price;

        // Other Details
        document.getElementById('driving_experience').innerText = form.driving_experience;
        document.getElementById('how_heard_about_us').innerText = form.how_heard_about_us;
        document.getElementById('extended_test').innerText = form.extended_test;

        // Show modal
        var myModal = new bootstrap.Modal(document.getElementById('formDetailsModal'));
        myModal.show();
    }
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(element) {
        element.addEventListener('click', function() {
            var myModal = bootstrap.Modal.getInstance(document.getElementById('formDetailsModal'));
            myModal.hide();
        });
    });
</script>
            <script>
    function switchmode(id) {
        if (id == 1) {
            document.getElementById('tblassignment').hidden = true;
            document.getElementById('tbltest').hidden = false;
            document.getElementById('tasslink').hidden = true;
            document.getElementById('trplink').hidden = false;
        } else {
            document.getElementById('tblassignment').hidden = false;
            document.getElementById('tbltest').hidden = true;
            document.getElementById('tasslink').hidden = false;
            document.getElementById('trplink').hidden = true;
        }
    }
    </script>

@endsection
