@extends('front-cms.layouts.main')
@section('main-section')
<div class="container">
    <div class="col-md-8">
        <h2>Early Driving Test Enquiry</h2>
        <p>
            This form is for driving instructors to request earlier driving test dates for their students, avoiding long waits. By providing key details, we can efficiently find and book cancellations that suit your student’s schedule. This form ensures that all crucial information is captured in one place, allowing us to efficiently search for cancellation slots that fit your student’s needs. It’s a hassle-free way to help students get on the road sooner!
        </p>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('driving.test.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Your Name, Business or Driving School</label>
                <input type="text" name="name" class="form-control" required>
            </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <!--<div class="mb-3">-->
            <!--    <label class="form-label">Enter Your Desired Test Centres</label>-->
            <!--     <select name="test_centres" class="form-control mb-2" id="" required>-->
            <!--        <option value="">Choose an option...</option>-->
            <!--        <option value="Test center 1" >Test center 1</option>-->
            <!--        <option value="Test center 2">Test center 2</option>-->
            <!--        <option value="Test center 3" >Test center 3</option>-->
            <!--    </select>-->
            <!--</div>-->
            
            {{-- Test Centre 1 (Required) --}}
            <div class="mb-3">
                <label class="form-label">Test Centre 1 *<span class="text-danger">*</span></label>
                <div class="d-flex gap-2">
                    <!--<select name="center1" class="form-control" required>-->
                    <!--    <option value="">Choose...</option>-->
                    <!--    <option value="center1">Test center 1</option>-->
                        <!--<option value="Test center 2">Test center 2</option>-->
                        <!--<option value="Test center 3">Test center 3</option>-->
                    <!--</select>-->
                    <input type="text" name="center1" class="form-control" placeholder="Enter custom name" required>
                </div>
            </div>
            
            {{-- Test Centre 2 (Optional) --}}
            <div class="mb-3">
                <label class="form-label">Test Centre 2 (Optional)</label>
                <div class="d-flex gap-2">
                    <!--<select name="center2" class="form-control">-->
                    <!--    <option value="">Choose...</option>-->
                        <!--<option value="Test center 1">Test center 1</option>-->
                    <!--    <option value="center2">Test center 2</option>-->
                        <!--<option value="Test center 3">Test center 3</option>-->
                    <!--</select>-->
                    <input type="text" name="center2" class="form-control" placeholder="Enter custom name">
                </div>
            </div>
            
            {{-- Test Centre 3 (Optional) --}}
            <div class="mb-3">
                <label class="form-label">Test Centre 3 (Optional)</label>
                <div class="d-flex gap-2">
                    <!--<select name="center3" class="form-control">-->
                    <!--    <option value="">Choose...</option>-->
                        <!--<option value="Test center 1">Test center 1</option>-->
                        <!--<option value="Test center 2">Test center 2</option>-->
                    <!--    <option value="center3">Test center 3</option>-->
                    <!--</select>-->
                    <input type="text" name="center3" class="form-control" placeholder="Enter custom name">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Earliest Possible Date</label>
                <input type="date" name="earliest_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Latest Possible Date</label>
                <input type="date" name="latest_date" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">License Number</label>
                <input type="text" name="license_number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Theory Number</label>
                <input type="text" name="theory_number" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<br>
<br>
@endsection
