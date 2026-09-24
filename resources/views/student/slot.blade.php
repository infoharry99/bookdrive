@extends('student.layouts.main')
@section('main-section')
<div class="page-content" style="
    margin-left: 300px;
">
            <div class="container-fluid">

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                    <br>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    <br>
                @endif
                <div id="" class="mb-3 listHeader page-title-box">
                    <a class="btn btn-primary" href="{{ route('tutor.studentslist') }}"><i class="fa fa-long-arrow-left"></i> My Student</a>
                    <div class="slotTitle">
                        <h3 class="mt-3">Slots Management </h3>
                        <button class="btn btn-sm btn-success bookingBtns1" style="margin-right: 5px" type="button"
                        onclick="openclassmodalcreate();"><i class="ri-calendar-todo-fill"></i> &nbsp;Create Slot</button>
                    </div>
                    
                   
                </div>
               <form action="{{ route('save.availability') }}" method="POST">
    @csrf
    <div class="mb-4">
        <div class="row">
            <!-- Dropdown Field -->
            <div class="col-md-6">
                <label for="tutor" class="form-label">Choose Tutor:</label>
                <select class="form-control" id="tutor" name="tutor_id">
                    <option value="" disabled selected>Select Tutor</option>
                    @foreach ($tutorlist as $tutor)
                        <option value="{{ $tutor->tutor_id }}">
                            {{ $tutor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date Picker Field -->
            <div class="col-md-6">
                <label for="slotDate" class="form-label">Choose Date:</label>
                <input type="date" class="form-control" id="slotDate" name="slotDate">
            </div>
        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary btn-sm mb-5">Show Availability</button>
    </div>
</form>

<!-- Time Slots -->
<div class="mb-4" id="timeSlots" style="display:none;">
    <h5 id="selectedDate"></h5>
    <div id="timeButtons"></div>
</div>
<button id="submitSelectedSlots" class="btn btn-primary">Save Selected Slots</button>
 <!--<div class="mb-4">-->
 <!--       <div class="row">-->
            <!-- Dropdown Field -->
 <!--           <div class="col-md-6">-->
 <!--               <label for="slotType" class="form-label">Choose Tutor:</label>-->
 <!--               <select class="form-control" id="tutor" name="tutor">-->
 <!--                   <option value="" disabled selected>Select Slot Type</option>-->
 <!--                   @foreach ($tutorlist as $tutor)-->
 <!--           <option value="{{ $tutor->tutor_id }}">-->
 <!--               {{ $tutor->name }}-->
 <!--           </option>-->
 <!--       @endforeach-->
                   
 <!--               </select>-->
 <!--           </div>-->

            <!-- Date Picker Field -->
 <!--           <div class="col-md-6">-->
 <!--               <label for="slotDate" class="form-label">Choose Date:</label>-->
 <!--               <input type="date" class="form-control" id="slotDate" name="slotDate">-->
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->
 <!--                   <div>-->
 <!--                       <button class="btn btn-primary btn-sm mb-5">Save Availability</button>-->
 <!--                   </div>-->
                    
                    
                <!--<div class="mb-4">-->
                <!--    <h5> Monday (28-09-2024)</h5>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                    

                <!--</div>-->

                <!--<div class="mb-4">-->
                <!--    <h5> Tuesday (29-09-2024)</h5>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                    

                <!--</div>-->

                <!--<div class="mb-4">-->
                <!--    <h5> Wednesday (30-09-2024)</h5>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                <!--    <button class="btn btn-sm btn-gray mb-2">6:00</button>-->
                    

                <!--</div>-->

                
            </div>
            <!-- content-wrapper ends -->


          

           

          

            
           
        </div>
<script>
// $('form').on('submit', function (e) {
//     e.preventDefault(); // Prevent default form submission

//     var formData = $(this).serialize(); // Get the form data

//     // Send the request to the server to get available slots
//     $.ajax({
//         url: '{{ route('save.availability') }}',
//         method: 'POST',
//         data: formData,
//         success: function (response) {
//             $('#timeSlots').empty(); // Clear previous time slots

//             if (response.availableSlots.length > 0) {
//                 let selectedSlots = []; // To track selected slots
//                 let currentRowDate = null; // To track the current row being selected

//                 // Group slots by date
//                 let groupedSlots = {};
//                 response.availableSlots.forEach(function (slotData) {
//                     if (!groupedSlots[slotData.date]) {
//                         groupedSlots[slotData.date] = [];
//                     }
//                     groupedSlots[slotData.date].push(slotData);
//                 });

//                 // Generate time slots for each date
//                 Object.keys(groupedSlots).forEach(function (date) {
//                     $('#timeSlots').append('<h5>Available Time Slots for ' + date + '</h5>');
//                     let dateButtons = $('<div id="dateButtons-' + date + '"></div>');

//                     groupedSlots[date].forEach(function (slotData) {
//                         let startTime = slotData.slot;
//                         let endTime = slotData.slot_end;

//                         let start = new Date('1970-01-01T' + startTime + 'Z');
//                         let end = new Date('1970-01-01T' + endTime + 'Z');

//                         while (start <= end) {
//                             let formattedTime = start.toISOString().substr(11, 5);

//                             dateButtons.append(
//                                 '<button class="btn btn-sm btn-gray mb-2 time-slot" data-date="' +
//                                     date +
//                                     '" data-start-time="' + startTime + '" data-end-time="' + endTime + '">' +
//                                     formattedTime +
//                                     '</button>'
//                             );

//                             start = new Date(start.getTime() + 15 * 60000); // Add 15 minutes
//                         }
//                     });

//                     $('#timeSlots').append(dateButtons);
//                 });

//                 $('.time-slot').on('click', function () {
//                     var selectedTime = $(this).text(); // Get the time from button
//                     var parentDate = $(this).data('date');
//                     var selectedStartTime = $(this).data('start-time');
//                     var selectedEndTime = $(this).text();
//                     var selectedDateTimeKey = parentDate + ' ' + selectedTime;
                    
//                     // Check availability before selecting the slot
//                     // checkAvailability(parentDate, selectedTime, selectedEndTime, function (isAvailable) {
//                     //     if (!isAvailable) {
//                     //         alert('This slot is already booked. Please choose another one.');
//                     //         return;
//                     //     }
                        

//                         // If slot is available, proceed with selection
//                         if ($(this).hasClass('selected')) {
//                             $(this).removeClass('btn-primary selected').addClass('btn-gray');
//                             selectedSlots = selectedSlots.filter((slot) => slot !== selectedDateTimeKey);

//                             // If no slots are selected, reset the current row
//                             if (selectedSlots.length === 0) {
//                                 currentRowDate = null;
//                             }
//                         } else {
//                             // If trying to select a slot in a different row
//                             if (currentRowDate && currentRowDate !== parentDate) {
//                                 let currentRowSlots = selectedSlots.filter((slot) => slot.startsWith(currentRowDate));
//                                 if (!isOneHourSelected(currentRowSlots)) {
//                                     alert('Please select at least 1 hour for the current date before moving to another row.');
//                                     return;
//                                 }
//                             }

//                             // Validate 1-hour selection
//                             var sameDateSlots = selectedSlots.filter((slot) => slot.startsWith(parentDate));
//                             if (sameDateSlots.length > 0) {
//                                 var allSelectedTimes = sameDateSlots.map((slot) => slot.split(' ')[1]);
//                                 allSelectedTimes.push(selectedTime); // Include the new slot

//                                 // Sort times to check for a 1-hour span
//                                 allSelectedTimes.sort();

//                                 var firstTime = new Date(parentDate + 'T' + allSelectedTimes[0] + 'Z');
//                                 var lastTime = new Date(parentDate + 'T' + allSelectedTimes[allSelectedTimes.length - 1] + 'Z');

//                                 var timeDifference = (lastTime - firstTime) / (60 * 1000); // Difference in minutes
//                                 if (timeDifference < 60) {
//                                     alert('You must select a minimum of 1 hour.');
//                                     return;
//                                 }
//                             }

//                             // Set the current row as the active row for selection
//                             currentRowDate = parentDate;

//                             // Mark the time slot as selected
//                             $(this).removeClass('btn-gray').addClass('btn-primary selected');
//                             selectedSlots.push(selectedDateTimeKey);
//                         }
//                     });
//                 });

//                 $('#timeSlots').show(); // Show the time slots section

//                 $('#submitSelectedSlots').on('click', function () {
//                     var tutorId = $('#tutor').val(); // Get the tutor's ID from the form
//                     var slotDate = $('#slotDate').val(); // Get the selected date

//                     // Prepare data to store
//                     var selectedData = {
//                         tutor_id: tutorId,
//                         slot_date: slotDate,
//                         slots: selectedSlots,
//                         start_times: selectedSlots.map(function (slot) {
//                             return slot.split(' ')[1]; // Extract start times from the selected slots
//                         }),
//                         end_times: selectedSlots.map(function (slot) {
//                             return slot.split(' ')[2]; // Extract end times from the selected slots
//                         })
//                     };

//                     // Send the selected slots to the server
//                     $.ajax({
//                         url: '{{ route('store.slot') }}', // This route should handle saving the data on the server side
//                         method: 'POST',
//                         data: {
//                             _token: '{{ csrf_token() }}',
//                             data: selectedData
//                         },
//                         success: function (response) {
//                             alert('Slots saved successfully!');
                                // window.location.reload();
//                         },
//                         error: function () {
//                             alert('An error occurred while saving the selected slots.');
//                         }
//                     });
//                 });

//             } else {
//                 $('#timeSlots').append('<p>No available slots for the selected dates.</p>');
//                 $('#timeSlots').show();
//             }
//         },
//         error: function () {
//             alert('An error occurred while fetching the available slots.');
//         }
//     });

//     // Helper function to check if a minimum of 1 hour is selected in a row
//     function isOneHourSelected(slots) {
//         if (slots.length < 2) return false;

//         let times = slots.map((slot) => {
//             let time = slot.split(' ')[1]; // Extract the time from "date time"
//             return new Date('1970-01-01T' + time + 'Z');
//         });

//         times.sort((a, b) => a - b); // Sort times in ascending order

//         let firstTime = times[0];
//         let lastTime = times[times.length - 1];

//         let difference = (lastTime - firstTime) / (60 * 1000); // Difference in minutes
//         return difference >= 60; // Minimum 1-hour span
//     }

//     // Function to check if the slot is available
//     function checkAvailability(date, startTime, endTime, callback) {
//          var tutorId = $('#tutor').val();
//         $.ajax({
//             url: '{{ route('save.cavailability') }}', // This route should check the availability of the slot
//             method: 'POST',
//             data: {
//                 _token: '{{ csrf_token() }}',
//                 date: date,
//                 start_time: startTime,
//                 end_time: endTime,
//                  tutor_id: tutorId,
//             },
//             success: function (response) {
//                 if (response.isAvailable) {
//                     callback(true); // Slot is available
//                 } else {
//                     callback(false); // Slot is not available
//                 }
//             },
//             error: function () {
//                 alert('An error occurred while checking availability.');
//                 callback(false);
//             }
//         });
//     }
// });


$('form').on('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    var formData = $(this).serialize(); // Get the form data

    // Send the request to the server
$.ajax({
    url: '{{ route('save.availability') }}',
    method: 'POST',
    data: formData,
    success: function (response) {
        console.log(response,'response')
        $('#timeSlots').empty(); // Clear previous time slots

        if (response.availableSlots.length > 0) {
            let selectedSlots = []; // To track selected slots
            let currentRowDate = null; // To track the current row being selected

            // Group available slots by date
            let groupedSlots = {};

            response.availableSlots.forEach(function (slotData) {
                if (!groupedSlots[slotData.date]) {
                    groupedSlots[slotData.date] = [];
                }
                groupedSlots[slotData.date].push(slotData);
            });
         
            // Create a list of existing slots for comparison (formatted as 'YYYY-MM-DD HH:MM:SS' ranges)
            let existingSlots = response.exists.map(function (slot) {
                // Create the start and end range of the slot
                return {
                    date: slot.slot_date,
                    start: slot.slot_date + ' ' + slot.slot_start_time,
                    end: slot.slot_date + ' ' + slot.slot_end_time
                };
            });
console.log(response.exists,'response.exists');
            // Generate time slots for each date
 // Generate time slots for each date
Object.keys(groupedSlots).forEach(function (date) {
    $('#timeSlots').append('<h5>Available Time Slots for ' + date + '</h5>');
    let dateButtons = $('<div id="dateButtons-' + date + '"></div>');

    groupedSlots[date].forEach(function (slotData) {
        let startTime = slotData.slot;
        let endTime = slotData.slot_end;

        let start = new Date('1970-01-01T' + startTime + 'Z');
        let end = new Date('1970-01-01T' + endTime + 'Z');

        let start1 = new Date(slotData.date + 'T' + startTime + 'Z');
        let end1 = new Date(slotData.date + 'T' + endTime + 'Z');

        while (start <= end) {
            let formattedTime = start.toISOString().substr(11, 5);  // Get the time in 'HH:MM' format
            let selectedDateTimeKey = date + ' ' + formattedTime;

            // Check if this time slot exists (already taken)
            let isExisting = false;

            existingSlots.forEach(function (existingSlot) {
                if (existingSlot.date === date) {
                    // Convert the existing slot times to match the required format
                    let existingStart = new Date(existingSlot.start.replace(' ', 'T') + 'Z');
                    let existingEnd = new Date(existingSlot.end.replace(' ', 'T') + 'Z');

                    // Check if the exact time matches an existing time slot
                    if (formattedTime >= existingStart.toISOString().substr(11, 5) && formattedTime < existingEnd.toISOString().substr(11, 5)) {
                        isExisting = true;
                        console.log(`Slot is taken: ${formattedTime} is within the range of ${existingStart.toISOString().substr(11, 5)} to ${existingEnd.toISOString().substr(11, 5)}`);
                    }
                }
            });

            // Append the time slot button with the appropriate color
            dateButtons.append(
                '<button class="btn btn-sm ' + (isExisting ? 'btn-danger' : 'btn-gray') + ' mb-2 time-slot" ' +
                (isExisting ? 'disabled' : '') + // Disable the button if it's already booked
                ' data-date="' + date +
                '" data-start-time="' + startTime + '" data-end-time="' + endTime + '">' +
                formattedTime +
                '</button>'
            );

            // Increment to the next 15-minute interval
            start = new Date(start.getTime() + 15 * 60000); // Add 15 minutes
        }
    });

    $('#timeSlots').append(dateButtons);
});





            // Handle time slot selection
            $('.time-slot').on('click', function () {
                var selectedTime = $(this).text(); // Get the time from button
                var parentDate = $(this).data('date');
                var selectedStartTime = $(this).data('start-time');
                var selectedEndTime = $(this).data('end-time');
                var selectedDateTimeKey = parentDate + ' ' + selectedTime;

                // If the slot is already taken (exists), prevent selection and show an alert
                if ($(this).hasClass('btn-danger')) {
                    alert('This slot is already taken.');
                    return;
                }

                // Check if the button is already selected
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('btn-primary selected').addClass('btn-gray');
                    selectedSlots = selectedSlots.filter((slot) => slot !== selectedDateTimeKey);

                    // If no slots are selected, reset the current row
                    if (selectedSlots.length === 0) {
                        currentRowDate = null;
                    }
                } else {
                    // If trying to select a slot in a different row
                    if (currentRowDate && currentRowDate !== parentDate) {
                        // Check if the current row has at least 1 hour selected
                        let currentRowSlots = selectedSlots.filter((slot) => slot.startsWith(currentRowDate));
                        if (!isOneHourSelected(currentRowSlots)) {
                            alert('Please select at least 1 hour for the current date before moving to another row.');
                            return;
                        }
                    }

                    // Validate 1-hour selection
                    var sameDateSlots = selectedSlots.filter((slot) => slot.startsWith(parentDate));
                    if (sameDateSlots.length > 0) {
                        var allSelectedTimes = sameDateSlots.map((slot) => slot.split(' ')[1]);
                        allSelectedTimes.push(selectedTime); // Include the new slot

                        // Sort times to check for a 1-hour span
                        allSelectedTimes.sort();

                        var firstTime = new Date(parentDate + 'T' + allSelectedTimes[0] + 'Z');
                        var lastTime = new Date(parentDate + 'T' + allSelectedTimes[allSelectedTimes.length - 1] + 'Z');

                        var timeDifference = (lastTime - firstTime) / (60 * 1000); // Difference in minutes
                        if (timeDifference < 60) {
                            alert('You must select a minimum of 1 hour.');
                            return;
                        }
                    }

                    // Set the current row as the active row for selection
                    currentRowDate = parentDate;

                    // Mark the time slot as selected
                    $(this).removeClass('btn-gray').addClass('btn-primary selected');
                    selectedSlots.push(selectedDateTimeKey);
                }
                 autoHighlightSlots(parentDate);
            });
            
            function autoHighlightSlots(date) {
                                let sameDateSlots = selectedSlots
                                    .filter((slot) => slot.startsWith(date))
                                    .map((slot) => slot.split(' ')[1])
                                    .sort();

                                highlightedSlots = [];

                                if (sameDateSlots.length >= 2) {
                                    let firstTime = new Date('1970-01-01T' + sameDateSlots[0] + 'Z');
                                    let lastTime = new Date('1970-01-01T' + sameDateSlots[sameDateSlots.length - 1] + 'Z');

                                    $('.time-slot[data-date="' + date + '"]').each(function () {
                                        let slotTime = $(this).text();
                                        let slotDateTime = new Date('1970-01-01T' + slotTime + 'Z');
                                        let slotKey = date + ' ' + slotTime;

                                        if (slotDateTime.getTime() === firstTime.getTime() || slotDateTime.getTime() === lastTime.getTime()) {
                                            // Keep first and last slot in selectedSlots
                                            $(this).removeClass('btn-gray btn-warning').addClass('btn-primary selected').prop('disabled', false);

                                            if (!selectedSlots.includes(slotKey)) {
                                                selectedSlots.push(slotKey);
                                            }
                                        } else if (slotDateTime > firstTime && slotDateTime < lastTime) {
                                            // Highlight the in-between slots and disable them
                                            $(this).removeClass('btn-gray').addClass('btn-warning').prop('disabled', true);

                                            if (!highlightedSlots.includes(slotKey)) {
                                                highlightedSlots.push(slotKey);
                                            }
                                        }
                                    });
                                }
                            }
                            
            $('#timeSlots').show(); // Show the time slots section

            $('#submitSelectedSlots').on('click', function () {
                var tutorId = $('#tutor').val(); // Get the tutor's ID from the form
                var slotDate = $('#slotDate').val(); // Get the selected date

                // Prepare data to store
                var selectedData = {
                    tutor_id: tutorId,
                    slot_date: slotDate,
                    slots: selectedSlots,
                    start_times: selectedSlots.map(function (slot) {
                        return slot.split(' ')[1]; // Extract start times from the selected slots
                    }),
                    end_times: selectedSlots.map(function (slot) {
                        return slot.split(' ')[2]; // Extract end times from the selected slots
                    })
                };
                         $.ajax({
                        url: '{{ route('store.slot') }}', // This route should handle saving the data on the server side
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data: selectedData
                        },
                        success: function (response) {
                            
                            alert('Slots saved successfully!');
                            window.location.reload();
                        },
                        error: function () {
                            console.log('An error occurred while saving the selected slots.');
                        }
                    });
       

                // Send the selected slots to the server
                // ... (send the data to the server)
            });

        } else {
            $('#timeSlots').append('<p>No available slots for the selected dates.</p>');
            $('#timeSlots').show();
        }
    },
    error: function () {
        alert('An error occurred while fetching the available slots.');
    }
});


    // Helper function to check if a minimum of 1 hour is selected in a row
    function isOneHourSelected(slots) {
        if (slots.length < 2) return false;

        let times = slots.map((slot) => {
            let time = slot.split(' ')[1]; // Extract the time from "date time"
            return new Date('1970-01-01T' + time + 'Z');
        });

        times.sort((a, b) => a - b); // Sort times in ascending order

        let firstTime = times[0];
        let lastTime = times[times.length - 1];

        let difference = (lastTime - firstTime) / (60 * 1000); // Difference in minutes
        return difference >= 60; // Minimum 1-hour span
    }
});


</script>





@endsection
