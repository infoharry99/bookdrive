@extends('front-cms.layouts.main')
@section('main-section')

<!-- Page Header Start -->
<div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">Affiliate Programme</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                <!-- <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li> -->
                <li class="breadcrumb-item text-primary active" aria-current="page">Affiliate Programme</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->



<div class="container-xxl">
    <div class="container">

        <h6 style="color:#F3BD00;">Work with Latimer Tuition.</h6>
        <h1 class="my-4"><span style="color:#F3BD00;">50% Commission</span> | Earn £115/referral</h1>

        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="faq-sec mt-5">
                    <div class="aff-img">
                        <img src="{{ url('frontendnew/img/user-add.png') }}" alt="">
                    </div>
                    <div class="faqs">
                        <h4>1. Sign up as a Latimer Tuition Affiliate</h4>
                        <p>Become an Affiliate today! Signing up is quick and easy. You'll receive your login details,
                            allowing you to manage your account, including adding your pay-out bank account details.</p>
                    </div>
                </div>

                <div class="faq-sec mt-3">
                    <div class="aff-img">
                        <img src="{{ url('frontendnew/img/refer.png') }}" width="70px;" alt="">
                    </div>
                    <div class="faqs">
                        <h4>2. Refer clients to us</h4>
                        <p>Refer a Client to us using our form. This will create the client's profile in our system, and
                            you will be assigned as their affiliate.</p>
                    </div>
                </div>

                <div class="faq-sec mt-3">
                    <div class="aff-img">
                        <img src="{{ url('frontendnew/img/function-process.png') }}" width="70px;" alt="">
                    </div>
                    <div class="faqs">
                        <h4>3. We'll handle the rest</h4>
                        <p>We will manage this client just like we do with all our other clients. They will be added to
                            our pipeline, and we will present them with tutor options to consider.</p>
                    </div>
                </div>


                <div class="faq-sec mt-3">
                    <div class="aff-img">
                        <img src="{{ url('frontendnew/img/benefit-porcent.png') }}" width="70px;" alt="">
                    </div>
                    <div class="faqs">
                        <h4>4. Monthly commission payments</h4>
                        <p>Within 5 working days of the first of each month, we will generate a payment order for your
                            account and transfer the commission due to your designated bank account on file.</p>
                    </div>
                </div>


            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="aff-btn">
                    <button class="btn btn-dark" onclick="becomeAffiliate();">Become an Affiliate</button>
                    <button class="btn btn-dark" onclick="refer();">Refer Instructor</button>
                    <button class="btn btn-dark" onclick="refer();">Refer Candidate</button>
                </div>
            </div>


        </div>


        <p class="py-5">£115 is the average earnings for affiliates from previous Latimer Tuition clients who start
            paying their invoices. Actual earnings may vary based on the client’s engagement and duration of services,
            and we cannot guarantee this amount will be paid. However, we can guarantee that you will receive 50% of all
            net commissions (Latimer Tuition's Commission) that we earn from the clients you refer.</p>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>

        <div class="faq-sec mt-5">
            <div>
                <img src="{{ url('frontendnew/img/calculator.png') }}" width="70px;" alt="">
            </div>
            <div class="faqs">
                <h4>How is the commission calculated?</h4>
                <p>We bill our clients on a per-lesson basis. Once a client of yours pays an invoice, our system
                    automatically adds a new line item to your draft payment order. This payment order will be finalised
                    and paid within 5 working days following the first of each month.</p>
            </div>
        </div>
    </div>
</div>





<!-- Modal Affiliate-->
<div class="modal fade instructor-profile" id="become-Affiliate" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Become an Affiliate</h5>
                <button type="button" class="close border-0" onclick="closeAffiliate();" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-2">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="mobile">Mobile Number</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Mobile">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeAffiliate();">Close</button>
                    <button type="button" class="btn btn-primary"
                    >Submit</button>

            </div>
        </div>
    </div>
</div>



<!-- Modal refer -->
<div class="modal fade instructor-profile" id="refer" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Refer Instructor/Candidate</h5>
                <button type="button" class="close border-0" onclick="closeRefer();" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                <div class="form-group mb-2">
                        <label for="referee-mobile">Referee Number</label>
                        <input type="number" class="form-control" id="referee-mobile" placeholder="Referee Mobile">
                    </div>
                    <div class="form-group mb-2">
                        <label for="name">Client Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Client Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="mobile">Mobile Number</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Mobile">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeRefer();">Close</button>
                    <button type="button" class="btn btn-primary"
                    >Submit</button>

            </div>
        </div>
    </div>
</div>


<script>
function becomeAffiliate() {
    $("#become-Affiliate").modal('show');
}

function closeAffiliate() {
    $("#become-Affiliate").modal('hide');
}

function refer(){
    $("#refer").modal('show');
}

function closeRefer() {
    $("#refer").modal('hide');
}
</script>


@endsection