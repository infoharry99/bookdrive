@extends('tutor.layouts.main')
@section('main-section')


<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">a
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <style>
    .listHeader {
        display: flex;
        justify-content: space-between;
    }

    .moveRight {
        float: right;
    }
    .star-rating {
    direction: rtl;
    display: inline-block;
}

.star-rating input {
    display: none;
}

.star-rating label {
    color: #ccc;
    font-size: 24px;
    padding: 0;
    cursor: pointer;
}

.star-rating input:checked ~ label {
    color: gold;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}

    </style>

    <div class="page-content">
        <div class="container-fluid">


            <div id="" class="mb-3 listHeader page-title-box">
                <h3>Scheduled Classes </h3>
                <a href="tutorslots"><button class="btn btn-sm btn-success"><i class="ri-calendar-todo-fill"></i>
                    View Slots</button></a>
            </div>
            @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            <div class="mt-4 table-responsive" id="">

                <table class="table table-hover table-striped align-middle mb-0 ">
                    <thead>
                        <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col">Student</th>
                            <th scope="col">Status</th>
                            <th scope="col">Slot Date & Time</th>
                            <th scope="col">Class Start Time</th>
                            <th scope="col">Class End Time</th>
                            <th scope="col">Topic</th>
                            <th scope="col">Remarks</th>
                            <th scope="col" class="text-center" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($liveclasses as $liveclass)

                  <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $liveclass->student_name }}</td>
                            <td>
                                @if ($liveclass->status == '1')
                                <span class="badge bg-success">Confirmed</span>
                            @elseif ($liveclass->status == '2')
                                <span class="badge bg-danger">Started</span>
                                @else
                                <span class="badge bg-primary">Completed</span>
                            @endif
                            </td>

                            <td>{{ \Carbon\Carbon::parse($liveclass->slotdate)->format('d-m-Y') }} {{ \Carbon\Carbon::parse($liveclass->slottime)->format('h:i A') }}</td>
                            <td>{{ $liveclass->class_start_time ? \Carbon\Carbon::parse($liveclass->class_start_time)->format('d-m-Y h:i A') : '' }}</td>
                            <td>{{ $liveclass->class_end_time ? \Carbon\Carbon::parse($liveclass->class_end_time)->format('d-m-Y h:i A') : '' }}</td>
                            <td>{{ $liveclass->topic }}</td>
                            <td>{{ $liveclass->remarks }}</td>
                            <td>
                                @if ($liveclass->status == '1')
                                <a href="startclass/{{$liveclass->id}}"><button class="btn btn-sm btn-success"> Start Class</button></a>
                            @elseif ($liveclass->status == '2')
                            <a href="#endclass"><button class="btn btn-sm btn-danger" onclick="endpopupmodal({{$liveclass->id}})"> End Class</button></a>
                                @else

                            @endif

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{-- {!! $demos->links() !!} --}}
                </div>
                {{-- <form action="{{ route('tutor.liveclass.store') }}" method="POST">
                @csrf
                <input type="text" id="url" name="url" value="{{ url()->full() }}">{{ url()->full('code') }}
                <button type="submit" class="success">Submit</button>
                </form> --}}
                <br>

                {{-- <form action="{{ route('tutor.liveclass.getuser') }}" method="GET">
                @csrf
                <input type="text" id="zuser" name="zuser"><button type="submit" class="success">Submit</button>
                </form> --}}

            </div>
        </div>
        <!-- content-wrapper ends -->
        <div class="modal fade" id="endclassnow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">End Class</h5>

                    </div>
                    <form id="change-class-status" action="{{route('tutor.endclassnow')}}" method="POST">
                        @csrf
                        <input type="hidden" id="liveclass-id" name="id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Enter Topic Here" name="topic" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Ratings To Student:</label>
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 stars">★</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 stars">★</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 stars">★</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 stars">★</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 star">★</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <textarea class="form-control" placeholder="Enter Remarks Here" name="remarks" rows="3" required></textarea>
                                </div>
                            </div>
                            <div style="float:right; margin-top:5px; margin-bottom:5px">
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function closeModal() {
        $('#scheduleclassmodal').modal('hide');
    }

    function openMarkModal(class_id) {
        $('#liveclass-id').val(class_id);
        $('#markcompleted').modal('show');
    }
    function endpopupmodal(id){
        $('#liveclass-id').val(id);
        $('#endclassnow').modal('show');
    }

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

    function fetchSubjects() {

        var classId = $('#class option:selected').val();
        $("#subject").html('');
        $("#topic").html('');
        $.ajax({
            url: "{{ url('fetchsubjects') }}",
            type: "POST",
            data: {
                class_id: classId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#subject').html('<option value="">-- Select Type --</option>');
                $.each(result.subjects, function(key, value) {
                    $("#subject").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });

            }

        });

    };

    function fetchTopics() {

        var subjectId = $('#subject option:selected').val();
        $("#topic").html('');
        $.ajax({
            url: "{{ url('fetchtopics') }}",
            type: "POST",
            data: {
                subject_id: subjectId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#topic').html('<option value="">-- Select Type --</option>');
                $.each(result.topics, function(key, value) {
                    $("#topic").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });

            }

        });

    };

    function batchbysubject() {

        var subjectId = $('#subject option:selected').val();
        $("#batchid").html('');
        $.ajax({
            url: "{{ url('batchbysubject') }}",
            type: "POST",
            data: {
                subject_id: subjectId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#batchid').html('<option value="">-- Select Type --</option>');
                $.each(result.batches, function(key, value) {
                    $("#batchid").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });

            }

        });

    };

    //     function warningModal(link){
    //     document.getElementById('warningbtn').innerHTML = `<a href="${link}"><button class="btn btn-sm btn-success">Ok</button></a>`;
    //     $('#warningModal').modal('show');

    // }
    function warningModal(id, link) {

        var url = "{{ URL('tutor/liveclass/status/update') }}";
        // var id=
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                status: status
            },
            success: function(dataResult) {
                dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode) {

                    toastr.success('status changed')
                    document.getElementById('warningbtn').innerHTML =
                        `<a href="${link}" target="_blank"><button class="btn btn-sm btn-success">Ok</button></a>`;
                    $('#warningModal').modal('show');

                } else {
                    alert("Something went wrong. Please try again later");
                }

            }
        });

    }
    </script>

@endsection

