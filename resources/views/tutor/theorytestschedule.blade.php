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
                <h3 class="mt-3">Theory Test Schedule </h3>
                <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#practicalpopup"><i
                        class="fa fa-plus"></i> &nbsp;Schedule Test</button>
            </div>



            <div class="mt-4" id="">

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middlemb-0">

                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Date Time</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>George</td>
                                <td>19-10-2024 12:30</td>
                                <td>Pass</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Harry</td>
                                <td>19-10-2024 12:30</td>
                                <td>Pass</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Oliver</td>
                                <td>19-10-2024 12:30</td>
                                <td>Pass</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Oscar</td>
                                <td>19-10-2024 12:30</td>
                                <td>Pass</td>


                            <tr>
                                <td>5</td>
                                <td>Noah</td>
                                <td>19-10-2024 12:30</td>
                                <td>Pass</td>
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
<div class="modal fade" id="practicalpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Theory Test Schedule</h5>
                <button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="name"
                            placeholder="Enter Name">
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="form-group">
                        <label for="name">Date & Time</label>
                        <input type="datetime-local" class="form-control" id="dateTime" aria-describedby="datetime">
                    </div>
                    </div>
                    <div class="col-12">

                    <div class="form-group" style="width:100%">
                        <label for="status">Status</label>
                        <select class="form-control" id="teststatus">
                            <option>--Select--</option>
                            <option>Pass</option>
                            <option>Fail</option>
                            <option>Pending</option>
                        </select>
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