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





            /* style.css */







.star {
font-size: 30px;
cursor: pointer;

}

.one {
color: orange;
}

.two {
color: orange;
}

.three {
color: gold;
}

.four {
color: gold;
}

.five {
color:lightgreen;
}



        </style>

        <div class="page-content">
            <div class="container-fluid">
                <a class="btn btn-primary" href="{{ route('tutor.studentslist') }}"><i class="fa fa-long-arrow-left"></i> My Student</a>
            @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif

                <h3 class="text-center">{{$studentdata->name}}'s Progress</h3>

                
                <div class="mt-4" id="">

                    <form action="{{ route('tutor.savestudentprogress') }}" method="POST">
                        @csrf
                        <input type="hidden" name="studentid" value="{{ $studentdata->id }}">
                        <div class="mt-4" id="skill-list">
                       
                            @foreach ($skilllists->groupBy('skill_type') as $skillType => $skills)
                                <h3>{{ $skillType }}</h3>
                                <table class="table skillTable">
                                @foreach ($skills as $skill)
                                    <div class="skill-item" >
                                    <input type="hidden" name="skills[{{ $loop->parent->index }}][skillid]" value="{{ $skill->id }}">
                                    <!-- <div class="skill-name">{{ $skill->skill_name }}</div> -->
                                   
                    
                                        <tbody>
                                            <tr>
                                                <td width="40%">{{ $skill->skill_name }}</td>
                                                <td width="30%">
                                                    <select name="skills[{{ $loop->parent->index }}][status]" class="form-control" name="" id="">
                                                        <option value="" disabled selected>Select status</option>
                                                        @foreach ($skillstatuses as $skillstatus)
                                                            <option value="{{ $skillstatus->id }}">{{ $skillstatus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td width="30%">
                                                    <div class="">
                                
                                                        <span onclick="progressrating(1)"
                                                            class="star">●
                                                        </span>
                                                        <span onclick="progressrating(2)"
                                                            class="star">●
                                                        </span>
                                                        <span onclick="progressrating(3)"
                                                            class="star">●
                                                        </span>
                                                        <span onclick="progressrating(4)"
                                                            class="star">●
                                                        </span>
                                                        <span onclick="progressrating(5)"
                                                            class="star">●
                                                        </span>
                                
                                                    </div>
                                                </td>
                                            </tr>

                                        
                                        </tbody>
                                    
                                        <!-- Skill ID -->
                                       
                                        
                                        <!-- Skill Status -->
                                        <!-- <div class="skill-status">
                                            <select name="skills[{{ $loop->parent->index }}][status]" class="form-control">
                                                <option value="" disabled selected>Select status</option>
                                                @foreach ($skillstatuses as $skillstatus)
                                                    <option value="{{ $skillstatus->id }}">{{ $skillstatus->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> -->
                                        <!-- Skill Rating -->
                                        <!-- <div class="skill-rating">
                                            <input type="number" name="skills[{{ $loop->parent->index }}][rating]" class="form-control" placeholder="Ratings" min="0" max="5" />
                                        </div> -->
                                    </div>
                                @endforeach
                                </table>
                            @endforeach
                            


                        </div>
                        <button type="submit" class="btn btn-primary">Save All</button>
                    </form>







                </div>

            </div>
            <!-- content-wrapper ends -->




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





// script.js

// To access the stars
    let stars = 
        document.getElementsByClassName("star");
    let output = 
        document.getElementById("output");

    // Funtion to update rating
    function progressrating(n) {
        remove();
        for (let i = 0; i < n; i++) {
            if (n == 1) cls = "one";
            else if (n == 2) cls = "two";
            else if (n == 3) cls = "three";
            else if (n == 4) cls = "four";
            else if (n == 5) cls = "five";
            stars[i].className = "star " + cls;
        }
        output.innerText = "Rating is: " + n + "/5";
    }

    // To remove the pre-applied styling
    function remove() {
        let i = 0;
        while (i < 5) {
            stars[i].className = "star";
            i++;
        }
    }

            </script>
        @endsection
