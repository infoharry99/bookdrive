@extends('front-cms.layouts.main')
@section('main-section')
    <!-- END header -->
     <!-- Page Header Start -->
     <div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Blog</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <!-- <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li> -->
                    <li class="breadcrumb-item text-primary active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- tutor section -->
    <section class="mt-5">
        <div class="container ">
            <div class="resourcesTop">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="resourcesBottom">
                        <h4>Featured</h4>
                        <h1>Blogs</h1>
                        <br>
                        <br>
                        <div class="freeClassBtn">
                          <button class="btn btn-primary" onclick="makearequest();">Quick Quotation</button>
                        </div>
                    </div>
                </div>
            </div>

            </div>
           



            <div class="row mt-5">
                @foreach ($blogs as $blog)
                
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="blog-card">
                        <img  src="{{ url('images/blogs/'.$blog->image) }}" width="100%" alt="">
                        <div class="blogDetails">
                            <span class="feature"><span>
                                <a href="resources/{{$blog->id}}"><h5 class="my-2" style="color: black">{{$blog->name}}</h5></a>
                                    <p class="bDesc">{!! Str::limit($blog->description, 150) !!}</p>
                                    <a href="resources/{{$blog->id}}">
                                        Read more
                                    </a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>

            <script>
            function redirect(){
                window.location.href = "{{('/student/register')}}";
            }

        </script>

        </div>

    </section>
@endsection
