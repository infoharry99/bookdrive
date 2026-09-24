@extends('tutor.layouts.main')
@section('main-section')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <style>
    .slotTitleq {
        display: flex;
        justify-content: space-between;
    }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            <div class="slotTitleq">
                <h3 class="mt-3">Practical Test Schedule </h3>
                <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#theorypopup"><i
                        class="fa fa-plus"></i> &nbsp;Schedule Test</button>
            </div>



            <div class="mt-4" id="">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middlemb-0">

                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Date Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>George</td>
                                <td>London</td>
                                <td>19-10-2024 12:30</td>
                                <td><button class="btn btn-sm btn-dark">Edit</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Harry</td>
                                <td>London</td>
                                <td>19-10-2024 12:30</td>
                                <td><button class="btn btn-sm btn-dark">Edit</button></td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Oliver</td>
                                <td>London</td>
                                <td>19-10-2024 12:30</td>
                                <td><button class="btn btn-sm btn-dark">Edit</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Oscar</td>
                                <td>London</td>
                                <td>19-10-2024 12:30</td>
                                <td><button class="btn btn-sm btn-dark">Edit</button></td>


                            <tr>
                                <td>5</td>
                                <td>Noah</td>
                                <td>London</td>
                                <td>19-10-2024 12:30</td>
                                <td><button class="btn btn-sm btn-dark">Edit</button></td>
                            </tr>
                        </tbody>

                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="theorypopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Practical Test Schedule</h5>
                <button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Student Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name"
                                    placeholder="Enter Name">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="location">Student Name</label>
                                <input type="text" class="form-control" id="location" aria-describedby="location"
                                    placeholder="Enter Location">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Date & Time</label>
                                <input type="datetime-local" class="form-control" id="dateTime"
                                    aria-describedby="datetime">
                            </div>
                        </div>
                        


                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">With Vehicle</label>
                            </div>
                        </div>


                    </div>
                    <div class=" mt-3" style="float:right">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>









                </form>

            </div>

        </div>
    </div>
</div>






@endsection