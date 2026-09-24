@extends('student.layouts.main')
@section('main-section')

<div class="main-content">
    <style>
        .listHeader {
            display: flex;
            justify-content: space-between;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            <div id="listHeader">
                <h3>Purchased Subjects</h3>
            </div>

            <div class="row mt-4">
                @php
                    $uniqueSubjects = [];  // Define outside the loop
                @endphp
                
                @foreach ($subjectlist as $subject)
                    @if (!in_array($subject->subjectid, $uniqueSubjects))
                        <div class="col-md-3 mt-2"> 
                            <div class="card">
                                <img src="{{ $subject->image ? url('images/subjects/' . $subject->image) : url('images/default.png') }}" class="card-img-top" alt="{{ $subject->subjectname }}" />
                                <div class="card-body">
                                    <h5 class="card-title">{{ $subject->subjectname }}</h5>
                                    <!-- <p class="card-text"><b>Tutor: </b>{{ $subject->tutorname }}</p> -->
                                    <p class="card-text"><b>Purchased On: </b>{{ $subject->payment_date }}</p>
                                    <a href="{{ url('student/subjects/syllabus') . '/' . $subject->subjectid }}" class="btn btn-sm btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $uniqueSubjects[] = $subject->subjectid;  // Store subject_id to avoid duplicates
                        @endphp
                    @endif
                @endforeach
            </div>

        </div>
    </div>
@endsection
