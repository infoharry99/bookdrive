@extends('front-cms.layouts.main')

@section('main-section')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-0 shadow-lg rounded-4">

                {{-- HEADER --}}
                <div class="card-header bg-success text-white text-center rounded-top-4 py-4">
                    <h2 class="mb-1">✅ Booking Confirmed</h2>
                    <p class="mb-0">Thank you! Your booking has been received.</p>
                </div>

                <div class="card-body p-4">

                    {{-- BOOKING DETAILS --}}
                    <div class="mb-4">
                        <h5 class="text-dark fw-bold mb-3">📋 Booking Details</h5>

                        <div class="bg-light rounded-3 p-3">
                            <p class="mb-1"><strong>Reference ID:</strong> {{ $finalId }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $email }}</p>
                            <p class="mb-1"><strong>Password:</strong> {{ $pass }}</p>
                            <p class="mb-1"><strong>Order ID:</strong> {{ $order_id }}</p>
                            <p class="mb-0 text-success fw-bold">
                                Amount: {{ $currency }} {{ number_format($amount,2) }}
                            </p>
                        </div>
                    </div>

                    {{-- PAYMENT SECTION --}}
                    <div class="mb-4">

                        <h5 class="text-primary fw-bold mb-3">💳 Payment Options</h5>

                        {{-- OPTION 1: BANK TRANSFER --}}
                        <div class="border rounded-4 p-4 bg-white shadow-sm mb-4">
                            <h6 class="fw-bold text-dark mb-3">🏦 Bank Transfer (UK)</h6>

                            <p class="mb-2"><strong>Account Name:</strong> Maryan Ali</p>
                            <p class="mb-2"><strong>Sort Code:</strong> 04-00-75</p>
                            <p class="mb-2"><strong>Account Number:</strong> 71319611</p>
                            <!-- <p class="mb-2"><strong>SWIFT/BIC:</strong> BUKBGB22</p>
                            <p class="mb-2"><strong>IBAN:</strong> GB14 BUKB 2035 9393 5250 23</p> -->

                            <p class="text-danger fw-bold mt-3">
                                Amount to Pay: {{ $currency }} {{ number_format($amount,2) }}
                            </p>

                            <div class="alert alert-info mt-3">
                                👉 Use <strong>{{ $finalId }}</strong> as payment reference.
                            </div>
                        </div>

                        {{-- OPTION 2: CASH --}}
                        <div class="border rounded-4 p-4 bg-light mb-4">
                            <h6 class="fw-bold text-dark mb-2">💵 Cash Payment Option</h6>
                            <p class="mb-0">
                                You can also pay in cash directly at our office.  
                                Please contact us before visiting to confirm your booking.
                            </p>
                        </div>

                        <!-- {{-- RECEIPT UPLOAD --}}
                        <div class="border rounded-4 p-4 bg-white shadow-sm">
                            <h6 class="fw-bold text-success mb-3">📤 Upload Payment Receipt</h6>

                            <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="order_id" value="{{ $order_id }}">
                                <input type="hidden" name="booking_id" value="{{ $finalId }}">

                                <div class="mb-3">
                                    <label class="form-label">Upload Screenshot / Receipt</label>
                                    <input type="file" name="receipt" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-success w-100">
                                    ✅ Submit Payment Proof
                                </button>
                            </form>
                        </div> -->

                        {{-- NOTE --}}
                        <div class="alert alert-warning mt-4">
                            ⚠️ After submitting payment proof, your order will be verified by our team.
                        </div>

                        <div class="alert alert-info">
                            📩 All orders and inquiries will be sent to: 
                            <strong>bookdriv@gmail.com</strong>
                        </div>

                    </div>

                    {{-- CONTACT --}}
                    <div class="text-center">
                        <h5 class="text-success fw-bold mb-3">📞 Confirm Your Payment</h5>

                        <p class="mb-3">Contact us after payment to activate your booking:</p>

                        <div class="d-grid gap-2">
                            <a href="tel:+447944661936" class="btn btn-success btn-lg rounded-pill">
                                📞 Call: +44 7960 520269
                            </a>

                            <a href="https://wa.me/447944661936" target="_blank" class="btn btn-outline-success btn-lg rounded-pill">
                                 WhatsApp
                            </a>
                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="text-center mt-4">
                        <a href="{{ url('/') }}" class="btn btn-primary rounded-pill px-4">
                            ⬅ Back to Home
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection