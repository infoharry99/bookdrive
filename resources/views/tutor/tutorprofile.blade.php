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

    .skillTag {
        display: flex;

    }

    .skillTag h5 {
        margin: 10px;
    }
    </style>
<link rel="stylesheet" href="{{url('frontend/css/profile.css')}}">
    <div class="page-content">
        <div class="container-fluid">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-xl-12 col-xxl-9">
                        <div class="tu-tutorprofilewrapp">
                            <span class="tu-cardtag"></span>
                            <div class="tu-profileview">
                                <figure>
                                    <img class="rounded-circle header-profile-user"
                                         src="{{ $tutorpd->profile_pic 
                                                    ? url('images/students/profilepics/' . $tutorpd->profile_pic) 
                                                    :  url('images/avatar/default-profile-pic.png') }}"
                                         alt="Header Avatar">
                                    <!--<img src="{{url('images/tutors/profilepics','/')}}{{ $tutorpd->profile_pic ?? url('images/avatar/default-profile-pic.png')}}" alt="image-description">-->
                                </figure>
                                <div class="tu-protutorinfo">
                                    <div class="tu-protutordetail">
                                        <div class="tu-productorder-content">
                                            <figure>
                                                <img src="{{url('images/tutors/profilepics','/')}}{{ $tutorpd->profile_pic ?? url('images/avatar/default-profile-pic.png')}}" alt="images">
                                            </figure>
                                            <div class="tu-product-title">
                                                <h3>{{$tutorpd->name}} <i class="icon icon-check-circle tu-greenclr" data-tippy-trigger="mouseenter" data-tippy-html="#tu-verifed" data-tippy-interactive="true" data-tippy-placement="top"></i></h3>
                                                <h5>{{$tutorpd->subject}}</h5>
                                            </div>
                                            <div class="tu-listinginfo_price">
                                                <span>Upto 4 classes</span>
                                                <h4>£{{ ((float)$tutorpd->rateperhour * (float)$tutorpd->admin_commission / 100)+$tutorpd->rateperhour }}/hr</h4>
                                            </div>
                                            <div class="tu-listinginfo_price">
                                                <span>5-9 classes</span>
                                                <h4>£{{ ((float)$tutorpd->rateperhour2 * (float)$tutorpd->admin_commission / 100)+$tutorpd->rateperhour2 }}/hr</h4>
                                            </div>
                                            <div class="tu-listinginfo_price">
                                                <span>more than 9 classes</span>
                                                <h4>£{{ ((float)$tutorpd->rateperhour3 * (float)$tutorpd->admin_commission / 100)+$tutorpd->rateperhour3 }}/hr</h4>
                                            </div>
                                        </div>
                                        <ul class="tu-tutorreview">
                                            @isset($reviews)

                                            <li>
                                                <span><em>({{count($reviews)}})</em> Reviews</span>
                                            </li>
                                            @endisset
                                            <li>
                                                <span><i class="fa fa-check-circle tu-colorgreen"><em>Qualification:</em></i><em>{{$tutorpd->qualification}}</em></span>
                                            </li>
                                            <li>
                                                <span><i class="fa fa-check-circle tu-colorgreen"><em>Experience:</em></i><em>{{$tutorpd->experience}}</em></span>
                                            </li>
                                        </ul>
                                        {{-- <div class="tu-detailitem">
                                            <h6>Certifications</h6>
                                            <div class="tu-languagelist">
                                                <ul class="tu-languages">
                                                    <li>{{$tutorpd->certification}}</li>
                                                     </ul>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="tu-actionbts">
                                <div class="tu-userurl">
                                    <i class="icon icon-globe"></i>
                                    <a href="{{$tutorpd->intro_video_link}}" target="_blank" style="margin-left: 10px; margin-bottom:10px"><button class="btn btn-sm btn-primary">Watch Intro</button></a>
                                    <a href="profileupdate" style="margin-left: 10px; margin-bottom:10px"><button class="btn btn-sm btn-dark">Update Profile</button></a>
                                </div>

                            </div>
                        </div>
                        <div class="tu-detailstabs">
                            <div class="tab-content tu-tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="tu-tabswrapper">
                                        <form action="" >
                                            <span class="text-danger" id="file-error"></span>
                                           

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Full Name<i style="color:red">*</i></label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                                            value="{{ $tutorpd->name ?? session('userid')->name }}" required disabled>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Gender</label>
                                                        <select type="text" class="form-control" id="gender" name="gender" value="">
                                                        
                                                            <option value="1" {{ ( $tutorpd->gender == "1") ? 'selected' : '' }} disabled>Male</option>
                                                            <option value="2" {{ ( $tutorpd->gender == "2") ? 'selected' : '' }} disabled>Female</option>
                                                            <option value="3" {{ ( $tutorpd->gender == "3") ? 'selected' : '' }} disabled>Other</option>
                                                        
                                                        </select disabled>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="">Mobile</label>
                                                        <input type="text" class="form-control" id="primarymobile" name="primarymobile"
                                                            placeholder="" value="{{ $tutorpd->mobile ?? session('userid')->mobile }}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            value="{{ $tutorpd->email ?? session('userid')->email }}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Experience</label>
                                                        <input type="text" class="form-control" id="experience" name="experience"
                                                            placeholder="experience" value="{{ $tutorpd->experience ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                        <div class="form-group col-md-12 mb-2">
                                                            <label for="">Headline</label>
                                                            <input type="text" class="form-control" id="headline" name="headline"
                                                                placeholder="Enter Headline" value="{{ $tutorpd->headline ?? '' }}" disabled>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="">Qualification/Cetification</label>
                                                            <textarea type="text" class="form-control" id="qualification" name="qualification"
                                                            placeholder="qualification/Cetification" value="{{ $tutorpd->qualification ?? '' }}"disabled ></textarea>
                                                        </div>

                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="">Details</label>
                                                            <textarea type="text" class="form-control" id="details1" name="details1"
                                                                placeholder="Enter Details" value="{{ $tutorpd->detail_1 ?? '' }}" disabled></textarea>
                                                        </div>
                                                    
                                                        {{-- Added new field for rate per hour based on profile starts here --}}
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="name">Rate Per Hour(£)<i style="color:red"> (for 1-4 classes)</i></label>
                                                            <input type="text" class="form-control" id="rateperhour" name="rateperhour"
                                                                placeholder="0" disabled readonly
                                                                value="{{ $tutorpd->rateperhour ?? 0}}"  disabled>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="name">Rate Per Hour(£)<i style="color:red"> (for 5-9 classes)</i></label>
                                                            <input type="text" class="form-control" id="rateperhour2" name="rateperhour2"
                                                                placeholder="0" disabled readonly
                                                                value="{{ $tutorpd->rateperhour2 ?? 0}}" disabled>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="name">Rate Per Hour(£)<i style="color:red"> (for more than 9 classes)</i></label>
                                                            <input type="text" class="form-control" id="rateperhour3" name="rateperhour3"
                                                                placeholder="0" disabled readonly
                                                                value="{{ $tutorpd->rateperhour3 ?? 0}}" disabled>
                                                        </div>
                                                        {{-- Added new field for rate per hour based on profile ends here --}}

                                                        <div class="form-group col-md-6 mb-2">
                                                            <label for="name">Intro Video Link</label>
                                                            <input type="text" class="form-control" id="introvideolink" name="introvideolink"
                                                                placeholder="https://youtube.com/abZpqYUppz"
                                                                value="{{ $tutorpd->intro_video_link ?? ''}}">
                                                        </div>

                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">package</label>
                                                        <select type="text" class="form-control select2" id="package" name="package" disabled>
                                                            <option value="">--Select--</option>
                                                            <option value="weekly" {{ isset($tutorpd) && $tutorpd->package == 'weekly' ? 'selected' : '' }}>weekly</option>
                                                            <option value="intense" {{ isset($tutorpd) && $tutorpd->package == 'intense' ? 'selected' : '' }}>intense</option>
                                                            <option value="both" {{ isset($tutorpd) && $tutorpd->package == 'both' ? 'selected' : '' }}>both</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Driver Payment</label>
                                                        <select type="text" class="form-control" id="driver_payment" name="driver_payment" disabled>
                                                            <option value="">--Select--</option>
                                                            <option value="Yes" {{ isset($tutorpd) && $tutorpd->driver_payment == 'Yes' ? 'selected' : '' }}>YES</option>
                                                            <option value="No" {{ isset($tutorpd) && $tutorpd->driver_payment == 'No' ? 'selected' : '' }}>NO</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Badge Expiry Date</label>
                                                        <input type="date" name="badge_expiry_date" class="form-control" value="{{$tutorpd->badge_expiry_date}}" disabled>
                                                    </div>
                                                    <label for="name">Badge License image</label> 
                                                    <div class="form-group col-md-6 mb-2">                                                      
                                                        <br>
                                                        @if(!empty($tutorpd->badge_image))
                                                            <img src="{{ asset($tutorpd->badge_image) }}" id="photo">
                                                        @else
                                                            <span> No image uploaded</span>
                                                        @endif
                                                        <br>
                                                    </div>

                                                    <br><br><br>
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="name">Driving License Expiry Date</label>
                                                        <input type="date" name="driving_expiry_date" class="form-control" value="{{$tutorpd->driving_expiry_date}}" disabled>
                                                    </div>
                                                    <label for="name"> Driving License Image</label>
                                                    <div class="form-group col-md-6 mb-2">
                                                        
                                                        @if(!empty($tutorpd->drive_image))
                                                            <img src="{{ asset($tutorpd->drive_image) }}" id="photo">
                                                        @else
                                                            <span> No image uploaded</span>
                                                        @endif
                                                        <!-- <input type="file" name="drive_image" class="form-control" disabled> -->
                                                    </div>

                                                    @if ( isset($tutorpd) && $tutorpd->document_link_1)
                                                        <div class="form-group col-md-4 mt-3">
                                                            <label for="name">Document 1 </label>
                                                        <a href="{{ $tutorpd->document_link_1}}" target="_blank"> <button class="btn btn-sm btn-dark" type="button">View</button></a>
                                                        </div>
                                                    @endif

                                                    @if ( isset($tutorpd) && $tutorpd->document_link_2)
                                                    <div class="form-group col-md-4 mt-3">
                                                        <label for="name">Document 2 </label>
                                                    <a href="{{ $tutorpd->document_link_2}}" target="_blank"> <button class="btn btn-sm btn-dark" type="button">View</button></a>
                                                    </div>
                                                    @endif

                                                    @if ( isset($tutorpd) && $tutorpd->document_link_3)
                                                    <div class="form-group col-md-4 mt-3">
                                                        <label for="name">Document 3 </label>
                                                    <a href="{{ $tutorpd->document_link_3}}" target="_blank"> <button class="btn btn-sm btn-dark" type="button">View</button></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>    
                                        </form>
                                        <hr>

                                        {{-- Achievement Add/Update --}}
                                        <h3 class="text-center my-5"><u>City/Area Mapping</u></h3>
                                        <hr>

                                        <table class="table table-hover table-striped align-middlemb-0 table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>City</th>
                                                    <th>Area</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tutorclassmappinggrid">
                                                @foreach ($tutorsub as $classmapping)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="text-wrap">{{ $classmapping->class }}</td>
                                                    <td class="text-wrap">{{ $classmapping->subject }}</td>
                                                    <td><a href="{{url('tutor/classmappingdelete')}}/{{$classmapping->id}}">
                                                        <button class="btn-sm btn btn-danger" type="button">
                                                            <span class="fa fa-trash"></span> Delete
                                                        </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tr>

                                                </tr>

                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="tu-tabswrapper">
                                        <div class="tu-boxtitle">
                                            @isset($reviews)

                                            <h4>Reviews ({{count($reviews)}})</h4>
                                            @endisset
                                        </div>
                                        @isset($reviews)


                                        @foreach ($reviews as $reviews)


                                    </tr>

                                        <div class="tu-commentarea">
                                            <div class="tu-commentlist">
                                                <figure>
                                                    <img src="{{url('images/students/profilepics','/')}}{{ $reviews->student_pic ?? url('images/avatar/default-profile-pic.png')}}" alt="images">
                                                </figure>
                                                <div class="tu-coomentareaauth">
                                                    <div class="tu-commentright">
                                                        <div class="tu-commentauthor">
                                                            <h6><span>{{$reviews->student_name}}</span></h6>
                                                            <div class="tu-listing-location tu-ratingstars">
                                                                <span>{{$reviews->ratings}}</span>
                                                                <span class="tu-stars tu-sm-stars">
                                                                    <span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tu-description">
                                                        <p>{{$reviews->name}} </div>
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                        @endisset
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="tu-Joincommunity">
                            <div class="tu-particles">
                                <div id="tu-particlev2"></div>
                            </div>
                            <div class="tu-Joincommunity_content">
                                <h4>Trending tutor directory of 2024</h4>
                                <p>Its Free, Join today and start spreading knowledge with students out there</p>
                            </div>
                            <div class="tu-Joincommunity_btn">
                                <a href="/tutor/register" class="tu-yellowbtn">Join our community</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



        </div>
        <!-- content-wrapper ends -->

        @endsection
