@extends('tutor.layouts.main')
@section('main-section')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <style>
            .listHeader {
                display: flex;
                justify-content: space-between;
            }
        </style>

        <div class="page-content">
            <div class="container-fluid">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                @if (count($students) > 0)
                <h3 class="text-center">Students</h3>
                <div class="mt-4" id="">

                    <div class="table-responsive">
                            <table class="table table-hover table-striped align-middlemb-0">

                                <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Student</th>
                                        <th scope="col">Registration</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $student->studentname }}</td>
                                            <td>DS121-2024{{ $loop->iteration }}</td>
                                            <td>
                                               <a href="/tutor/studentprogress/{{$student->studentid}}"> <button
                                                    class="btn btn-sm btn-primary">View Progress</button></a>
                                                <button
                                                        class="btn btn-sm btn-primary" onclick="theorymodal({{$student->studentid}})">Theory</button>
                                                <button type="button"
                                                            class="btn btn-sm btn-primary" onclick="showpayments({{$student->studentid}})">Payments</button>
                                                <form action="{{ route('tutor.slots.search') }}" method="GET" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" value="{{ $student->studentid }}" id="selectstudent" name="selectstudent">
                                                    <button type="submit" class="btn btn-sm btn-primary">View Slots</button>
                                                </form>
                                                <a href="studentmessages/{{ $student->studentid }}"><button
                                                            class="btn btn-sm btn-success">Start Chat</button></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{-- {!! $demos->links() !!} --}}
                            </div>


                    </div>
                </div>
                @else
                            <div style="display: flex; justify-content:center">

                                <img src="{{ asset('images/no-data-found.jpg') }}" width="400px">
                            </div>
                        @endif
            </div>
            <!-- content-wrapper ends -->


            <div class="modal fade" id="studentpayments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Change to modal-lg for smaller width -->
        <div class="modal-content">
            <div class="modal-body">
                <header>
                    <h3 class="text-center mb-4">Payment List</h3>
                </header>

                <form action="" method="">
                    <div class="row">
                        <div class="col-12 col-md-12 col-ms-12 mb-3">
                            <style>
                                .newclass td,
                                .newclass th {
                                    padding: 2px !important;
                                }
                            </style>
                            <table class="table table-bordered newclass" style="margin: 0%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Transaction No.</th>
                                        <th>Date</th>
                                        <th>Amount(£)</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody id="paymentlist">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- Theory Modal --}}
<div class="modal fade" id="theorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <header>
                    <h3 class="text-center mb-4">Update Theory Details</h3>
                </header>

                <form action="updatetheory" method="POST">
                    @csrf
                    <input type="hidden" id="studentid" name="studentid">
                    <div class="row">

                        <div class="col-12 col-md-12 col-ms-6 mb-3">
                            <label>Location<span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="enter location" required>
                        </div>
                        <div class="col-12 col-md-12 col-ms-6 mb-3">
                            <label>Date<span style="color:red">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="select date" required>
                        </div>
                        <div class="col-12 col-md-12 col-ms-6 mb-3">
                            <label>Marks<span style="color:red">*</span></label>
                            <select class="form-control" name="marks" required>
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12 col-ms-6 mb-3">
                            <label>Description<span style="color:red">*</span></label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="enter description" required></textarea>
                        </div>



                    </div>

                    <div style="float:right">

                        <button type="submit" id="" class="btn btn-sm btn-success "><span
                                class="fa fa-check"></span>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





            <script>
                function openclassmodal(batchid, subjectid) {
                    $('#batchid').val(batchid);
                    $("#topic").html('');
                    $.ajax({
                        url: "{{ url('fetchtopics') }}",
                        type: "POST",
                        data: {
                            subject_id: subjectid,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#topic').html('<option value="">-- Select Topic --</option>');
                            $.each(result.topics, function(key, value) {
                                $("#topic").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });

                        }

                    });

                    $('#scheduleclassmodal').modal('show')

                }

                function openstudentmodal(id) {
                    var classId = $('#classname option:selected').val();
                    $("#subject").html('');
                    $.ajax({
                        url: "{{ url('tutor/batches/students') }}/" + id,
                        type: "GET",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            // console.log(result)
                            $('#studentlist').html('');
                            $.each(result, function(key, value) {
                                // $("#studentlist").append(value.name);
                            });
                            var table = "";
                            var p = 0;
                            for (var i in result) {
                                p++;
                                table += "<tr>";
                                table += "<td hidden>" +
                                    result[i].id + "</td>" +
                                    "<td>" + p + "</td>" +
                                    "<td>" + result[i].name + "</td>";
                                table += "</tr>";
                            }

                            document.getElementById("studentlist").innerHTML = table;
                        }

                    });
                    // $('#studentlist').val()
                    $('#studentlistmodal').modal('show')

                }
                function showpayments(id) {
    $.ajax({
        url: "{{ url('tutor/student/payments') }}/" + id,
        type: "GET",
        data: {
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(result) {
            $('#paymentlist').html(''); // Clear previous data

            var table = "";
            var p = 0;

            // Helper function to format the date and time
            function formatDateTime(dateString) {
                const dateObj = new Date(dateString);
                const day = ("0" + dateObj.getDate()).slice(-2); // Add leading zero if needed
                const month = ("0" + (dateObj.getMonth() + 1)).slice(-2); // Month is 0-indexed, so add 1
                const year = dateObj.getFullYear();

                // Extract hours and minutes
                let hours = dateObj.getHours();
                const minutes = ("0" + dateObj.getMinutes()).slice(-2);
                const ampm = hours >= 12 ? 'PM' : 'AM';

                // Convert 24-hour time to 12-hour time
                hours = hours % 12;
                hours = hours ? hours : 12; // If hour is 0, set it to 12 (midnight case)

                // Return formatted date and time
                return `${day}-${month}-${year} ${hours}:${minutes} ${ampm}`;
            }

            // Loop through the result to build the table
            for (var i in result) {
                p++;
                const formattedDate = formatDateTime(result[i].created_at); // Format the date

                table += "<tr>";
                table += "<td hidden>" + result[i].id + "</td>";
                table += "<td>" + p + "</td>";
                table += "<td>" + result[i].transaction_id + "</td>";
                table += "<td>" + formattedDate + "</td>"; // Add formatted date here
                table += "<td>" + (result[i].classes_purchased * result[i].rate_per_hr) + "</td>"; // Add calculated total
                table += "<td><p style='color:green'>Success</p></td>"; // Static status for demonstration
                table += "</tr>";
            }

            // Set the table content
            document.getElementById("paymentlist").innerHTML = table;
        }
    });

    $('#studentpayments').modal('show');
}

function theorymodal(id){
    $.ajax({
                        url: "{{ url('tutor/gettheory') }}/" + id,
                        type: "GET",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {

                            if(Object.keys(data).length > 0){
                                document.getElementById("studentid").value = data.student_id;
                                document.getElementById("location").value = data.location;
                                document.getElementById("date").value = data.date;
                                document.getElementById("marks").value = data.marks;
                                document.getElementById("description").value = data.description;
                            }
                            else{
                                document.getElementById("studentid").value = id;
                                document.getElementById("location").value = '';
                                document.getElementById("date").value = '';
                                document.getElementById("marks").value = '';
                                document.getElementById("description").value = '';
                            }
                        }

                    });
            $('#theorymodal').modal('show');
}
            </script>
        @endsection
