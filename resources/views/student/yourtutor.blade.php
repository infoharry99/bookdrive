@php
use App\Models\payments\paymentstudents;
use App\Models\students\studentattendance;
@endphp
@extends('student.layouts.main')
@section('main-section')
<!-- partial -->
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
            <style>
            .card .card-title {
                margin-bottom: 0;
            }

            .cardBtn {
                width: 90%;
                margin-top: 4px;
            }

            .bookedSlot,
            .startChat {
                width: 50% !important;
            }
            </style>
            <link rel="stylesheet" href="{{url('frontend/css/profile.css')}}">
            <h3 class="text-center mb-2">Your Instructor</h3>
            <hr>
<div class="row">
    @if(isset($tutorlist))
        @php
            $processedTutors = []; // Track processed tutor_id and class_id combinations
        @endphp
        @foreach ($tutorlist as $tutor)
            @if(!in_array([$tutor->tutor_id, $tutor->class_id], $processedTutors))
                @php
                    $processedTutors[] = [$tutor->tutor_id, $tutor->class_id];
                @endphp
                @if($tutor->tutor_id != 1)
                    <div class="col-xl-4 col-xxl-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="card instructorCard">
                            <img class="card-img-top"
                                 src="{{ $tutor->profile_pic ? url('images/tutors/profilepics/' . $tutor->profile_pic) : url('images/avatar/default-profile-pic.png') }}"
                                 alt="image">

                            <div class="card-body">
                                <h6 class="card-title"><a href="{{url('#')}}">{{ $tutor->name }}</a></h6>
                                <p class="card-text">Experience summary...</p>
                                <a href="/student/tutorprofile/{{ $tutor->tutor_id }}" class="btn btn-primary-tp">View Profile</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-4 col-xxl-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="card instructorCard">
                            <div class="card-body">
                                <h6 class="card-title">No tutor Assign Yet</h6>
                            </div>
                        </div>
                    </div>
                @endif
                
            @endif
        @endforeach
    @endif
</div>


            <div class="row" style="display:none;">

                @if(isset($tutorlist))
                @foreach ($tutorlist as $tutorlist)
                <?php


                        $class_purchased = paymentstudents::where('student_id', session('userid')->id)
                            ->where('class_id', $tutorlist->class_id)
                            ->where('tutor_id', $tutorlist->tutor_id)
                            ->where('subject_id', $tutorlist->subjectid)
                            ->sum('classes_purchased');

                        $enrollment_data = paymentstudents::where('student_id', session('userid')->id)
                            ->where('class_id', $tutorlist->class_id)
                            ->where('tutor_id', $tutorlist->tutor_id)
                            ->where('subject_id', $tutorlist->subjectid)
                            ->select('classes_purchased', 'rate_per_hr')
                            ->get();

                        $total_amount_paid = 0;

                        foreach ($enrollment_data as $enrollment) {
                            $total_amount_paid += $enrollment->classes_purchased * $enrollment->rate_per_hr;
                        }


                        $first_purchase_date = paymentstudents::where('student_id', session('userid')->id)
                        ->where('class_id', $tutorlist->class_id)
                        ->where('tutor_id', $tutorlist->tutor_id)
                        ->where('subject_id', $tutorlist->subjectid)
                        ->select('created_at')
                        ->orderBy('created_at', 'asc') // Assuming you want to order by creation date to get the first purchase
                        ->first();
                        $formatted_date = ($first_purchase_date) ? $first_purchase_date->created_at->format('d/m/Y h:i a') : null;


                        $class_attended = studentattendance::where('student_id', session('userid')->id)
                        ->where('class_id', $tutorlist->class_id)
                        ->where('tutor_id', $tutorlist->tutor_id)
                        ->where('subject_id', $tutorlist->subjectid)
                        ->count();


                        ?>
                <div class="col-xl-4 col-xxl-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="">



                        <div class="card instructorCard">
                            <img class="card-img-top"
                                src="{{ url('images/tutors/profilepics', '/') }}{{ $tutorlist->profile_pic ?? url('images/avatar/default-profile-pic.png') }}"
                                alt="imge">

                            <div class="card-body">

                                <h6 class="card-title"><a href="{{url('#')}}">{{ $tutorlist->name }}</a> <i
                                        class="icon icon-check-circle tu-greenclr" data-tippy-trigger="mouseenter"
                                        data-tippy-html="#tu-verifed" data-tippy-interactive="true"
                                        data-tippy-placement="top"></i></h6>
                                <div class="tu-listing-location">
                                    <span>{{$tutorlist->starrating ?? '0'}} <i
                                            class="fa-solid fa-star"></i><em></em></span>
                                    <address><i class="icon icon-map-pin"></i> </address>
                                </div>
                                <p class="card-text">With over a decade of experience as a certified driving instructor,
                                    John Doe has helped hundreds of learners confidently navigate the roads....</p>

                                    <a href="/student/tutorprofile/{{ $tutorlist->tutor_id }}" class="btn btn-primary-tp">View
                                    Profile</a>
                                    {{-- <a href="enrollupdate/{{$tutorlist->tutor_id}}" class="bookedSlot"><button class="btn btn-sm btn-success">Booked Slots</button></a> --}}
                                {{-- <a href="tutormessages/{{$tutorlist->tutor_id}}" class="btn btn-primary-tp">Slots</a> --}}
                                {{-- <a href="tutormessages/{{$tutorlist->tutor_id}}" class="btn btn-primary-tp">Chat</a> --}}
                            </div>
                        </div>





                    </div>
                </div>

                @endforeach
                @endif
                {{-- @foreach ($tutorlist as $tutorlist)
                    <div class="col-md-3 mb-3">
                        <div class="card tutorCrad" style="width: 100%;">
                            <img src="{{ url('images/tutors/profilepics', '/') }}{{ $tutorlist->profile_pic ?? url('images/avatar/default-profile-pic.png') }}"
                class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $tutorlist->name }}</h5>
                    <div class="mb-1">
                        @if ($tutorlist->starrating >= 1)
                        <span class="fa fa-star checked"></span>
                        @endif
                        @if ($tutorlist->starrating >= 2)
                        <span class="fa fa-star checked"></span>
                        @endif
                        @if ($tutorlist->starrating >= 3)
                        <span class="fa fa-star checked"></span>
                        @endif
                        @if ($tutorlist->starrating >= 4)
                        <span class="fa fa-star checked"></span>
                        @endif
                        @if ($tutorlist->starrating >= 5)
                        <span class="fa fa-star checked"></span>
                        @endif
                    </div>
                    <p><b>Class:</b>{{ $tutorlist->class_name }}</p>
                    <p><b>Subject:</b>{{ $tutorlist->subject }}</p>
                    <?php


                                $class_purchased = paymentstudents::where('student_id', session('userid')->id)
                                    ->where('class_id', $tutorlist->class_id)
                                    ->where('tutor_id', $tutorlist->tutor_id)
                                    ->where('subject_id', $tutorlist->subjectid)
                                    ->sum('classes_purchased');

                                $enrollment_data = paymentstudents::where('student_id', session('userid')->id)
                                    ->where('class_id', $tutorlist->class_id)
                                    ->where('tutor_id', $tutorlist->tutor_id)
                                    ->where('subject_id', $tutorlist->subjectid)
                                    ->select('classes_purchased', 'rate_per_hr')
                                    ->get();

                                $total_amount_paid = 0;

                                foreach ($enrollment_data as $enrollment) {
                                    $total_amount_paid += $enrollment->classes_purchased * $enrollment->rate_per_hr;
                                }


                                $first_purchase_date = paymentstudents::where('student_id', session('userid')->id)
                                ->where('class_id', $tutorlist->class_id)
                                ->where('tutor_id', $tutorlist->tutor_id)
                                ->where('subject_id', $tutorlist->subjectid)
                                ->select('created_at')
                                ->orderBy('created_at', 'asc') // Assuming you want to order by creation date to get the first purchase
                                ->first();
                                $formatted_date = ($first_purchase_date) ? $first_purchase_date->created_at->format('d/m/Y h:i a') : null;


                                $class_attended = studentattendance::where('student_id', session('userid')->id)
                                ->where('class_id', $tutorlist->class_id)
                                ->where('tutor_id', $tutorlist->tutor_id)
                                ->where('subject_id', $tutorlist->subjectid)
                                ->count();


                                ?>
                    <p><b>Total Classes Purchased: </b>{{ $class_purchased ?? '-' }}</p>
                    <p><b>Current Rate:</b> <span>&#163;</span>{{ $tutorlist->rate }}</p>
                    <a href="tutorprofile/{{ $tutorlist->sub_map_id }}" class="btn btn-sm btn-primary-tp">Profile</a>
                    <button class="btn btn-sm btn-primary-tp"
                        onclick="openDemoModal('{{ $tutorlist->tutor_id }}','{{ $tutorlist->name }}','{{ $tutorlist->class_name }}','{{ $tutorlist->subjectid }}','{{ $tutorlist->subject }}','{{ $class_purchased ?? '-' }}','{{ $total_amount_paid ?? '-' }}','{{ $formatted_date ?? '_'}}','{{ $class_attended ?? '-'}}')">Classes
                    </button>
                </div>
            </div>
        </div>
        @endforeach --}}
    </div>
</div>
<!-- content-wrapper ends -->

<!-- modal -->
<div class="modal fade" id="openClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <style>
            table tr td,
            table tr th {
                padding: 10px !important;
            }
            </style>

            <div class="modal-body">
                <header>
                    <h3 class="text-center mb-4">Details</h3>
                </header>
                <form method="" action="">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody name="classDetalsTable">
                            <tr>
                                <th>Student Name</th>
                                <td id="studentName">{{session('userid')->name}}</td>
                            </tr>
                            <tr>
                                <th>Tutor Name</th>
                                <td id="tutorName"></td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td id="className"></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td id="subjectName"></td>
                            </tr>
                            <tr>
                                <th>Enrollment Date</th>
                                <td id="enrollmentDate"></td>
                            </tr>
                            <tr>
                                <th>Paid Amount</th>
                                <td id="paidAmount"></td>
                            </tr>
                            <tr>
                                <th>Total Classes</th>
                                <td id="totalClassCount"></td>
                            </tr>

                            <tr>
                                <th>Available Classes</th>
                                <td id="totalAvailableClass"></td>
                            </tr>

                            <tr>
                                <th>Attended Classes</th>
                                <td id="totalAttendedClass"></td>
                            </tr>
                        </tbody>

                    </table>
                    <div class="row float-right mt-2">
                        <div class=" col-12 col-md-12 col-sm-12" id="fullDetailsBtn">
                            {{-- <button class="btn btn-primary-tp">View Full Details</button> --}}
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

<script>
function openDemoModal(id, name, className, subjectId, subjectName, classPurchased, totalAmountPaid, enrollmentDate,
    classAttended) {
    // alert(totalAmountPaid)


    // document.getElementById('studentName').innerHTML = name;
    document.getElementById('tutorName').innerHTML = name;
    document.getElementById('className').innerHTML = className;
    document.getElementById('subjectName').innerHTML = subjectName;
    document.getElementById('enrollmentDate').innerHTML = enrollmentDate;
    document.getElementById('paidAmount').innerHTML = totalAmountPaid;
    document.getElementById('totalClassCount').innerHTML = classPurchased;
    document.getElementById('totalAvailableClass').innerHTML = classPurchased - classAttended;
    document.getElementById('totalAttendedClass').innerHTML = classAttended;
    // document.getElementById('fullDetailsBtn').innerHTML = "<a href='completed-classes'><button class='btn btn-primary-tp'>View All Classes</button></a>";
    $("#openClassModal").modal('show');
}
</script>
<!-- content-wrapper ends -->
@endsection
