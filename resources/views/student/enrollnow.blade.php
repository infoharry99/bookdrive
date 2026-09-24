@extends('student.layouts.main')
@section('main-section')
<div class="main-content">

    <style>
        .listHeader {
            display: flex;
            justify-content: space-between;
        }
        /* Additional styles omitted for brevity */
    </style>

    <div class="page-content">
        <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif

            <div class="mb-3 listHeader page-title-box">
                <h3>Enroll Now</h3>
            </div>
            <div class="avalability">
                <i class="fa fa-square red" style="color: #F49D8C" aria-hidden="true"></i><span>&nbsp;Not Available</span>
                <i class="fa fa-square green" style="color: #0BB39C" aria-hidden="true"></i><span>&nbsp;Available</span>
                <i class="fa fa-square blue" style="color: #405189" aria-hidden="true"></i><span>&nbsp;Selected</span>
            </div>
            <div id="free-class-warning" class="alert alert-warning mt-3" style="display: none;">
                You Exits free class other you have pay 
            </div>
            <form id="payment-form">
                @csrf
                <div id="successModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Success</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p id="successMessage"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="redirectButton">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-3 mt-4">
                        <label for="">Tutor</label>
                        <input type="hidden" id="tutorenrollid" name="tutorenrollid" value="{{ $enrollment->tutor_id }}">
                        <input type="text" class="form-control readonly" name="tutorenroll" id="tutorenroll" readonly value="{{ $enrollment->tutor_name }}">
                        <span class="text-danger">@error('tutorenrollid') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-3 mt-4" hidden>
                        <input type="hidden" id="subjectenrollid" name="subjectenrollid" value="{{ $enrollment->subject_id }}">
                        <input type="hidden" class="form-control readonly" name="subjectenroll" id="subjectenroll" readonly value="{{ $enrollment->subject_name }}">
                        <span class="text-danger">@error('subjectenrollid') {{ $message }} @enderror</span>
                    </div>
                    @if($FreeClasses == 0)
                        <div class="col-md-2 mt-4">
                            <label for="">Rate/Hr(£)(upto 4 classes)</label>
                            <input type="text" class="form-control readonly" name="rateperhourenroll" id="rateperhourenroll" readonly value="{{ $enrollment->rate }}">
                            <span class="text-danger">@error('rateperhourenroll') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-md-2 mt-4">
                            <label for="">Rate/Hr(£)(for 5-9 classes)</label>
                            <input type="text" class="form-control readonly" name="rateperhourenroll2" id="rateperhourenroll2" readonly value="{{ $enrollment->rate2 }}">
                            <span class="text-danger">@error('rateperhourenroll2') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-md-2 mt-4">
                            <label for="">Rate/Hr(£)(more than 9 classes)</label>
                            <input type="text" class="form-control readonly" name="rateperhourenroll3" id="rateperhourenroll3" readonly value="{{ $enrollment->rate3 }}">
                            <span class="text-danger">@error('rateperhourenroll3') {{ $message }} @enderror</span>
                        </div>
                        <input type="number" class="form-control" name="requiredclassenroll" id="requiredclassenroll" hidden required>
                        <div class="col-md-2 mt-4">
                            <label for="">Total Amount(£)</label>
                            <input type="text" class="form-control readonly" name="totalamountenroll" id="totalamountenroll" readonly>
                            <span class="text-danger">@error('totalamountenroll') {{ $message }} @enderror</span>
                        </div>
                    @else
                        <input type="hidden" class="form-control readonly" name="rateperhourenroll" id="rateperhourenroll" readonly value="{{ $enrollment->rate }}">
                        <input type="hidden" class="form-control readonly" name="totalamountenroll" id="totalamountenroll" readonly>
                        <input type="hidden" class="form-control readonly" name="rateperhourenroll2" id="rateperhourenroll2" readonly value="{{ $enrollment->rate2 }}">
                        <input type="hidden" class="form-control readonly" name="rateperhourenroll3" id="rateperhourenroll3" readonly value="{{ $enrollment->rate3 }}">
                         <input type="number" class="form-control" name="requiredclassenroll" id="requiredclassenroll" hidden required>
                        <div class="col-md-3 mt-4">
                            <label for="">Free Classes</label>
                            <input type="text" class="form-control readonly" readonly value="{{$FreeClasses}}">
                        </div>
                    @endif
                </div>

                <hr>

                <div class="full-width-table-responsive">
                    <table class="table table-hover table-striped align-middle table-nowrap mb-0 users-table" style="height: 260px;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Slots</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedSlots as $date => $slots)
                                <tr>
                                    <td>{{ $date }}</td>
                                    <td>
                                        @foreach ($slots as $slot)
                                            @php
                                                $formattedTime = \Carbon\Carbon::parse($slot['time'])->format('h:i A');
                                            @endphp
                                            <button type="button"
                                                class="slot-btn btn btn-sm btn-{{ $slot['is_available'] ? 'success' : 'danger' }}"
                                                data-date="{{ $date }}" data-time="{{ $formattedTime }}"
                                                data-slot-id="{{ $slot['id'] }}"
                                                {{ $slot['is_available'] ? '' : 'disabled' }}>
                                                {{ $formattedTime }}
                                            </button>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="display: flex; justify-content:space-between" class="my-3">
                    <div>
                        <input type="hidden" id="slotids" name="slotids">
                        <input type="checkbox" id="contactadmin" name="contactadmin"> <span><label for="contactadmin"> Please select to contact Instructor for any support.</label> &nbsp;</span>
                        <button type="submit" style="height: 50px" class="btn btn-primary">Proceed</button>
                    </div>
                </div>
            </form>
            <div class="modal fade" id="extraClassModal" tabindex="-1" role="dialog" aria-labelledby="extraClassModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Paid Class Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span>&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    You've selected more than your free class limit. If you continue, you'll need to pay for the additional classes.
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="cancelSlotSelection">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSlotSelection">Continue</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        $(document).ready(function () {
            $("#payment-form").submit(function (e) {
            e.preventDefault(); 
            $.ajax({
                url: "{{ route('student.purchaseclass') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
    
                        $("#successMessage").text(response.success);
                        $("#successModal").modal("show");
                        $("#redirectButton").click(function () {
                            window.location.href = response.redirect;
                        });
                    }
                },
                error: function (xhr) {
                    alert("Something went wrong. Please try again.");
                }
            });
        });
        });
        
        $(document).ready(function() {
            
            var selectedSlots = [];
            var freeClasses = {{ $FreeClasses }};
            var pendingSlot = null;
            
            $('.slot-btn').on('click', function () {
                var $button = $(this);
                var date = $button.data('date');
                var time = $button.data('time');
                var slotId = $button.data('slot-id');
            
                if (!$button.hasClass('selected')) {
                    if (selectedSlots.length >= freeClasses) {
                        // show confirmation modal
                        pendingSlot = { button: $button, date, time, slotId };
                        $('#extraClassModal').modal('show');
                    } else {
                        addSlot($button, date, time, slotId);
                    }
                } else {
                    removeSlot($button, date, time, slotId);
                }
            });
            
            // Add selected slot
            function addSlot($button, date, time, slotId) {
                selectedSlots.push({ date, time, slotId });
                $button.addClass('selected').removeClass('btn-success').addClass('btn-primary');
                updateRequiredClassesAndTotal();
            }
            
            // Remove selected slot
            function removeSlot($button, date, time, slotId) {
                selectedSlots = selectedSlots.filter(slot => !(slot.date === date && slot.time === time && slot.slotId === slotId));
                $button.removeClass('selected btn-primary').addClass('btn-success');
                updateRequiredClassesAndTotal();
            }
            
            // Handle modal "Continue"
            $('#confirmSlotSelection').on('click', function () {
                if (pendingSlot) {
                    addSlot(pendingSlot.button, pendingSlot.date, pendingSlot.time, pendingSlot.slotId);
                    pendingSlot = null;
                }
                $('#extraClassModal').modal('hide');
            });
            
            // Handle modal "Cancel"
            $('#cancelSlotSelection').on('click', function () {
                pendingSlot = null;
                $('#extraClassModal').modal('hide');
            });
            //     $('.slot-btn').on('click', function () {
                    
            //         var $button = $(this);
            //         var date = $button.data('date');
            //         var time = $button.data('time');
            //         var slotId = $button.data('slot-id');
                    
            //         if (!$button.hasClass('selected')) {
                        
            //             selectedSlots.push({ date: date, time: time, slotId: slotId });
            //             $button.addClass('selected').removeClass('btn-success').addClass('btn-primary');
                        
            //         } else {
                        
            //             selectedSlots = selectedSlots.filter(slot => !(slot.date === date && slot.time === time && slot.slotId === slotId));
            //             $button.removeClass('selected').removeClass('btn-primary').addClass('btn-success');
                        
            //         }
            //         updateRequiredClassesAndTotal();
            // });
            
            // function updateRequiredClassesAndTotal() {
            //     var requiredClasses = selectedSlots.length;
            //     $('#requiredclassenroll').val(requiredClasses); 
            
            //     var freeClasses = {{ $FreeClasses }};
            //     var paidClasses = requiredClasses - freeClasses;
            //     var totalAmount = 0;
            
            //     var rate1 = parseFloat($('#rateperhourenroll').val()) || 0;
            //     var rate2 = parseFloat($('#rateperhourenroll2').val()) || 0;
            //     var rate3 = parseFloat($('#rateperhourenroll3').val()) || 0;
            
            //     // Update cost
            //     if (paidClasses > 0) {
            //         if (paidClasses <= 4) {
            //             totalAmount = paidClasses * rate1;
            //         } else if (paidClasses <= 9) {
            //             totalAmount = paidClasses * rate2;
            //         } else {
            //             totalAmount = paidClasses * rate3;
            //         }
            //     }
            
            //     $('#totalamountenroll').val(totalAmount.toFixed(2));
            //     $('#slotids').val(selectedSlots.map(slot => slot.slotId).join(','));
            
            //     // Show/hide warning
            //     if (paidClasses > 0) {
            //         $('#free-class-warning').show().html(
            //             `You have selected <strong>${requiredClasses}</strong> slot(s). You have <strong>${freeClasses}</strong> free class(es). You will need to pay for <strong>${paidClasses}</strong> class(es).`
            //         );
            //     } else {
            //         $('#free-class-warning').hide();
            //     }
            // }

            function updateRequiredClassesAndTotal() {
                var requiredClasses = selectedSlots.length;
                $('#requiredclassenroll').val(requiredClasses); 
                
                // Update hidden input
                // Get the rates from the input fields
                
                var rate1 = parseFloat($('#rateperhourenroll').val());
                var rate2 = parseFloat($('#rateperhourenroll2').val());
                var rate3 = parseFloat($('#rateperhourenroll3').val());
        
                var totalAmount = 0;
                
                if (requiredClasses >= 1 && requiredClasses <= 4) {
                    totalAmount = requiredClasses * rate1;
                } else if (requiredClasses >= 5 && requiredClasses <= 9) {
                    totalAmount = requiredClasses * rate2;
                } else if (requiredClasses > 9) {
                    totalAmount = requiredClasses * rate3;
                }
    
                $('#totalamountenroll').val(totalAmount.toFixed(2));
                
                $('#slotids').val(selectedSlots.map(slot => slot.slotId).join(','));
            }
        });
        
    </script>
@endsection
