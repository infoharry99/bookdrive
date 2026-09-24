@extends('tutor.layouts.main')
@section('main-section')


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            {{-- @if (Session::has('success')) --}}
            {{-- @endif
                @if (Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif --}}
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Dashboard</h4>
                                    @if (session('userid')->is_active == 0)
                                    <div class="alert alert-danger">Your account is inactive. Please log out and log in again to check the status. If the issue persists, please contact the admin.  To chat with admin <a href="adminmessages" class="btn btn-sm btn-primary-tp">Click here</a></div>

                                    @endif

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li> --}}
                                        {{-- <li class="breadcrumb-item active">Analytics</li> --}}
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3">
                    <div class="card card-animate dashboardcard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="dashCard">
                                    <p class="fw-medium  mb-0"><b>Student Enrolled</b></p>
                                    <div class="topCradCount">
                                        <h2 class="pt-2" style="color:#D63531;"><span class="counter-value" data-target="{{$studentscount ?? "0"}}">{{$studentscount ?? "0"}}</span>
                                        </h2>

                                    </div>
                                </div>
                            </div>
                            <div style="float:right">
                                <a href="{{url('tutor/students')}}" class="text-decoration-underline"><button
                                        class="badge bg-secondry p-2 text-dark border-0">View
                                        All</button></a>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3">
                    <div class="card card-animate dashboardcard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="dashCard">
                                    <p class="fw-medium  mb-0"><b>Total Classes</b></p>
                                    <div class="topCradCount">
                                        <h2 class="pt-2 text-primary"><span class="counter-value1"
                                                data-target="">{{$totalUpcomingClasses}}</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right">
                                <a href="getclasslist" class="text-decoration-underline"><button
                                        class="badge bg-secondry p-2 text-dark border-0">View
                                        All</button></a>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3">
                    <div class="card card-animate dashboardcard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="dashCard">
                                    <p class="fw-medium  mb-0"><b>Leads Accepted</b></p>
                                    <div class="topCradCount">
                                        <h2 class="pt-2" style="color: #88B0F1"><span class="counter-value" data-target="{{$pending_demos ?? '0'}}">{{$pending_demos ?? '0'}}</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right">
                                <a href="#leadsall" class="text-decoration-underline"><button
                                        class="badge bg-secondry p-2 text-dark border-0">View
                                        All</button></a>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>

                <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3">
                    <div class="card card-animate dashboardcard">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="dashCard">
                                    <p class="fw-medium  mb-0"><b>Total Earnings</b></p>
                                    <div class="topCradCount">
                                        <h2 class="pt-2" style="color: #59C069">£<span class="counter-value" data-target="{{$moneyEarned ?? "0"}}">{{$moneyEarned ?? "0"}}</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right">
                                <a href="payouts" class="text-decoration-underline"><button
                                        class="badge bg-secondry p-2 text-dark border-0">View
                                        All</button></a>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div>

            </div>

            <div class="row">

                
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="card card-animate">
                        <div class="cardTitle">
                            <h5>Leads</h5>
                            <a href="#demolist"><b>View All</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table dash_table">
                                    <thead>
                                        <tr class="">

                                            <th>Student</th>
                                            <th>City</th>
                                            <th>Area</th>
                                            <th class="text-nowrap">No. Of Classes</th>
                                            <th>Start Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($leads as $lead)
                                        <tr>

                                            <td class="text-nowrap">{{$lead->full_name}}</td>
                                            <td class="text-nowrap">{{$lead->city_name}}</td>
                                            <td class="text-nowrap">{{$lead->area_name}}</td>
                                            <td class="text-nowrap">{{$lead->no_of_classes}}</td>
                                            <td class="text-nowrap">{{ \Carbon\Carbon::parse($lead->start_date)->format('d-m-Y') }}</td>
                                            <td class="text-nowrap"><button class="btn btn-sm btn-primary-tp">Start Chat</button></td>
                                         </tr>
                                        @endforeach

                                    {{--
                                        <tr>
                                            <td>
                                                <div class="namePic">
                                                    <img src="/images/students/profilepics/1688709846.jpg"
                                                        alt="">
                                                    <span>Deepesh</span>
                                                </div>
                                            </td>
                                            <td>Maths</td>

                                            <td>Today<br>10:00am</td>
                                            <td> <span class="confirm">Conffirmed</span></td>
                                            <td><span class="hrsLeft">9 Hours Left</span></td>
                                        </tr>



                                        <tr>
                                        <td>
                                                <div class="namePic">
                                                    <img src="/images/students/profilepics/1688709846.jpg"
                                                        alt="">
                                                    <span>Deepesh</span>
                                                </div>
                                            </td>
                                            <td>Maths</td>

                                            <td>Today<br>10:00am</td>
                                            <td> <span class="pending">Pending</span></td>
                                            <td>
                                                <div class="apprv">
                                                <span class="accept">Accept</span>
                                                <span class="reject">Reject</span>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td>
                                                <div class="namePic">
                                                    <img src="/images/students/profilepics/1688709846.jpg"
                                                        alt="">
                                                    <span>Deepesh</span>
                                                </div>
                                            </td>
                                            <td>Maths</td>

                                            <td>Today<br>10:00am</td>
                                            <td> <span class="pending">Pending</span></td>
                                            <td>
                                                <div class="apprv">
                                                <span class="accept">Accept</span>
                                                <span class="reject">Reject</span>

                                                </div>
                                            </td>
                                        </tr> --}}
                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="card card-animate">
                        <div class="cardTitle">
                            <h5>Scheduled Classes</h5>
                            <a href="getclasslist"><b>View All</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table dash_table  table-responsive">
                                    <thead>
                                        <tr class="">

                                            <th>Student</th>
                                            <th>Topic</th>
                                            <th>Date & Time</th>
                                            <th>Status</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($upcomingClasses as $class)
                                        <tr>
                                            <td>{{$class->student_name}}</td>
                                            <td>{{$class->topic}}</td>
                                            <td>{{$class->date ? Carbon\Carbon::parse($class->date)->format('d-m-Y') :''}} {{$class->slot ? Carbon\Carbon::parse($class->slot)->format(' h:i A') :''}} </td>
                                            <td>
                                                @if ($class->status == '1')
                                                <span class="badge bg-success">Confirmed</span>
                                            @elseif ($class->status == '2')
                                                <span class="badge bg-danger">Started</span>
                                                @else
                                                <span class="badge bg-primary">Completed</span>
                                            @endif
                                            </td>
                                            {{-- <td>
                                                @if ($class->status == 'Started')
                                               <a href="{{$class->join_url}}" target="_blank"> <span class="endClass"> Join Class</span></a>
                                                @else
                                                 <a href="getclasslist">   <span class="endClass"> Start Class</span> </a>

                                                @endif
                                            </td> --}}
                                            {{-- <td><span class="endClass"> End Class</span></td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>


                        </div>
                    </div>
                </div>

                
            </div> <!-- end row-->

            <div class="row" hidden>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="card card-animate">
                        <div class="cardTitle">
                            <h5>Homework</h5>
                            <div class="hwMenu" hidden>
                                <a href="#test" onclick="switchmode(1)"><span class="test">Test</span></a>
                                <a href="#assignment" onclick="switchmode(2)"><span class="test">Assignment</span></a>

                            </div>
                            <a href="assignments" id="trplink"><b>View All</b></a>
                            <a href="/student/assignments" id="tasslink" hidden><b>View All</b></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table trialtable dash_table" id="tbltest">
                                    <!-- <thead>
                                        <tr class="">
                                            <th>Subject</th>
                                            <th>Test Name</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>

                                    </tbody>


                                </table>

                                <table class="table trialtable dash_table " id="tblassignment" hidden>
                                    <thead>
                                        <tr class="">
                                            <th>Subject</th>
                                            <th>Assignment Name</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Maths</td>
                                            <td>Algebra</td>
                                            <td>Today 10:00am</td>

                                            <td><span class="test">Test</span></td>
                                        </tr>

                                        <tr>
                                            <td>Maths</td>
                                            <td>Algebra</td>
                                            <td>Today 10:00am</td>

                                            <td><span class="quizs">Quiz</span></td>
                                        </tr>
                                    </tbody>


                                </table>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="card card-animate">
                        <div class="cardTitle">
                            <h5>Results </h5>
                            <div class="hwMenu">
                                <a href="#testreports" onclick="testprogress(1)"><span class="assign">Test
                                        Report</span></a>
                                <a href="#progressreports" onclick="testprogress(2)"><span class="assign">Progress
                                        Report</span></a>
                            </div>
                            <a href="onlinetestlist"><b>View All</b></a>
                        </div>
                        <div class="card-body" id="testreport">

                            <div class="table-responsive">
                                <table class="table trialtable dash_table" id="">
                                    <thead>
                                        <tr class="">

                                            <th>Total Marks</th>
                                            <th>Test</th>
                                            <th>Obtained</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>



                                </table>
                            </div>
                        </div>
                        <div class="card-body" id="progressreport" hidden>

                            <table class="table trialtable dash_table table-responsive">
                                <thead>
                                    <tr class="">
                                        <th>Subject</th>
                                        <th>Total Tests</th>
                                        <th>Progress</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>



                            </table>
                        </div>
                    </div>
                </div>

                <!-- end row-->
            </div>




                    <div class="row" hidden>
                        <div class="col-xxl-5">
                            <div class="d-flex flex-column h-100">
                                <div class="row h-100" hidden>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="alert alert-success border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                                    {{-- <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i> --}}
                                                    <div class="flex-grow-1 text-truncate">
                                                        Welcome To Dashboard

                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <a  class="text-reset text-decoration-underline"><b>{{session('userid')->name}}!</b></a>
                                                    </div>
                                                </div>

                                                <div class="row align-items-end">
                                                    <div class="col-sm-12">
                                                        <div class="p-3">
                                                            <p class="fs-16 lh-base">"Education is the key to unlocking a world of possibilities, and with this online tuition app, we're not just gaining knowledge; we're gaining the future. Welcome to a journey of learning, where every lesson brings us closer to our dreams. Together, let's explore, discover, and excel. Here's to the start of an exciting educational adventure!"</p>

                                                            <div class="mt-3">
                                                                {{-- <a href="pages-pricing.html" class="btn btn-primary-tp">Upgrade Account!</a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-4">
                                                        <div class="px-3">
                                                            <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div> <!-- end card-body-->
                                        </div>
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Demo Pending</p>
                                                       <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$pending_demos ?? '0'}}">{{$pending_demos ?? '0'}}</span></h4>
                                                            <a href="{{url('tutor/demolist')}}" class="text-decoration-underline">View details</a>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="users" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Classes Taken</p>
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$classes_taken ?? '0'}}">{{$classes_taken ?? '0'}}</span></h4>
                                                            <a href="{{url('tutor/getclasslist')}}" class="text-decoration-underline">View details</a>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="activity" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Total Earning</p>
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">£<span class="counter-value" data-target="{{$moneyEarned->total_earned ?? "0"}}">{{$moneyEarned->total_earned ?? "0"}}</span></h4>
                                                            <a href="{{url('tutor/payments')}}" class="text-decoration-underline">View details</a>
                                                        </div></div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="clock" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-md-6">
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-muted mb-0">Students Enrolled</p>
                                                        <div>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$moneyEarned->student_count ?? "0"}}">{{$moneyEarned->student_count ?? "0"}}</span></h4>
                                                            <a href="{{url('tutor/batches')}}" class="text-decoration-underline">View details</a>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                                <i data-feather="external-link" class="text-info"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div> <!-- end row-->
                            </div>
                        </div> <!-- end col-->


                    </div> <!-- end row-->


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


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
