@extends('front-cms.layouts.main')

@section('main-section')
       

<div class="container-fluid py-3 bg-secondary">
    <div class="container">
        <div class="advSearchSec">
            <!-- Display Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('storeforms') }}" method="POST">
                @csrf
                <!-- Hidden Inputs for Postcode and Mobile Number -->
              
                <input type="hidden" name="opt_in" value="{{ $priceDetailId }}">

                <h6 class="text-white text-center fw--700">Have you passed your theory test??</h6>
                <div class="row manAuto">
                    <!-- Yes Option -->
                    <div class="col-6">
                        <div class="weeklyBox">
                            <input type="radio" name="passed_theory" value="yes" id="theory-yes" {{ old('passed_theory') == 'yes' ? 'checked' : '' }} onclick="showTheoryDate();" />
                            <div class="weeklyBtn">
                                <p>Yes</p>
                            </div>
                        </div>
                    </div>
                    <!-- No Option -->
                    <div class="col-6">
                        <div class="weeklyBox">
                            <input type="radio" name="passed_theory" value="no" id="theory-no" {{ old('passed_theory') == 'no' ? 'checked' : '' }} onclick="showTheoryOptions();" />
                            <div class="weeklyBtn">
                                <p>No</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- If "Yes" is selected for theory test -->
                <div id="theory-date" style="display: none;">
                    <h6 class="text-white text-center fw--700">Roughly what date did you pass your theory test?</h6>
                    <input type="date" name="theory_date" class="form-control" value="{{ old('theory_date') }}" />
                </div>

                <!-- If "No" is selected for theory test -->
                <div id="theory-options" style="display: none;">
                    <h6 class="text-white text-center fw--700">Are you sure you do not want us to book you a quicker theory test?</h6>
                    <div class="row manAuto">
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="book_quicker_theory" value="yes" id="book-theory-yes" {{ old('book_quicker_theory') == 'yes' ? 'checked' : '' }} onclick="showFastTrackOptions();" />
                                <div class="weeklyBtn">
                                    <p>Add Discounted Test</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="book_quicker_theory" value="no" id="book-theory-no" {{ old('book_quicker_theory') == 'no' ? 'checked' : '' }} onclick="showFastTrackOptions();" />
                                <div class="weeklyBtn">
                                    <p>No thanks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fast-Track Theory Test Options -->
                <div id="fasttrack-options" style="display: none;">
                    <h6 class="text-white text-center fw--700">Increase your chances of passing your theory test with an online zoom theory training course?</h6>
                    <div class="row manAuto">
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="zoom_training" value="yes" id="zoom-training-yes" {{ old('zoom_training') == 'yes' ? 'checked' : '' }} onclick="showRevisionAppOptions();" />
                                <div class="weeklyBtn">
                                    <p>Yes (+£30)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="zoom_training" value="no" id="zoom-training-no" {{ old('zoom_training') == 'no' ? 'checked' : '' }} onclick="showRevisionAppOptions();" />
                                <div class="weeklyBtn">
                                    <p>No</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revision App Option -->
                <div id="revision-app-options" style="display: none;">
                    <h6 class="text-white text-center fw--700">Subscribe to the best theory revision app?</h6>
                    <div class="row manAuto">
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="revision_app" value="yes" id="revision-app-yes" {{ old('revision_app') == 'yes' ? 'checked' : '' }} />
                                <div class="weeklyBtn">
                                    <p>Yes (+£3 per month)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="weeklyBox">
                                <input type="radio" name="revision_app" value="no" id="revision-app-no" {{ old('revision_app') == 'no' ? 'checked' : '' }} />
                                <div class="weeklyBtn">
                                    <p>No</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> SEARCH</button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Show/Hide Fields -->
<script>
    // Function to show theory date field when "Yes" is selected
    function showTheoryDate() {
        document.getElementById('theory-date').style.display = 'block';
        document.getElementById('theory-options').style.display = 'none';
        document.getElementById('fasttrack-options').style.display = 'none';
        document.getElementById('revision-app-options').style.display = 'none';
    }

    // Function to show options for booking a quicker theory test when "No" is selected
    function showTheoryOptions() {
        document.getElementById('theory-date').style.display = 'none';
        document.getElementById('theory-options').style.display = 'block';
        document.getElementById('fasttrack-options').style.display = 'none';
        document.getElementById('revision-app-options').style.display = 'none';
    }

    // Function to show additional fast track options when either "Add Discounted Test" or "No thanks" is selected
    function showFastTrackOptions() {
        document.getElementById('fasttrack-options').style.display = 'block';
        document.getElementById('revision-app-options').style.display = 'none'; // Hide initially
    }

    // Function to show revision app options when Zoom training is selected
    function showRevisionAppOptions() {
        document.getElementById('revision-app-options').style.display = 'block';
    }
</script>

@endsection
