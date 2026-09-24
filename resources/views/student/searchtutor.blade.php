@extends('student.layouts.main')
@section('main-section')


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div id="" class="mb-3 listHeader page-title-box">
            <h3>Assessment Readyness</h3>
        </div>
        <style>
        .canvasjs-chart-credit{
            display:none;
        }
    </style>
    <div id="chartContainer" style="height: 300px; max-width: 920px; margin: 0px auto; margin-bottom:70px"></div>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle table-nowrap mb-0 users-table">
                <thead class="">
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Instructor</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Comments</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>12-09-2024</td>
                        <td>Joseph</td>
                        <td>Traffic Rules</td>
                        <td>6/10</td>
                        <td class="text-wrap">You've made great progress! Your confidence behind the wheel has improved, and you're mastering key skills like smooth braking and turning. Keep practicing, and remember to stay calm and focused. You're on the right track to becoming a safe driver!</td>
                        
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>12-09-2024</td>
                        <td>Joseph</td>
                        <td>Traffic Rules</td>
                        <td>6/10</td>
                        <td class="text-wrap">You've made great progress! Your confidence behind the wheel has improved, and you're mastering key skills like smooth braking and turning. Keep practicing, and remember to stay calm and focused. You're on the right track to becoming a safe driver!</td>
                        
                    </tr>

                    
                </tbody>




            </table>
        </div>

    </div>

    

    @endsection