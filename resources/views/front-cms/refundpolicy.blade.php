@extends('front-cms.layouts.main')
@section('main-section')

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Refund & Cancellation Policy — BookDriving</title>
  <style>


    .wrap{
      max-width:var(--maxw);
      margin:40px auto;
      padding:24px;
    }
    .card{
      background:var(--card);
      border-radius:12px;
      box-shadow:0 8px 30px rgba(17,24,39,0.06);
      padding:28px;
    }
    header h1{
      margin:0 0 6px;
      font-size:1.5rem;
      letter-spacing:-0.2px;
    }
    header p.meta{
      margin:0;
      color:var(--muted);
      font-size:0.95rem;
    }
    section{ margin-top:20px; }
    h2{ font-size:1.05rem; margin:18px 0 8px; color:#0f172a; }
    p{ margin:0 0 12px; color:#111827; }
    ul{ margin:0 0 12px 20px; }
    li{ margin:6px 0; }
    .note{ font-size:0.95rem; color:var(--muted); background:#f3f4f6; padding:12px; border-radius:8px; }
    .contact{ margin-top:14px; padding:14px; border-left:4px solid var(--accent); background:#fff; border-radius:8px; }
    .muted{ color:var(--muted); font-size:0.95rem; }
    a.mail{ color:var(--accent); text-decoration:none; }
    footer { margin-top:22px; font-size:0.9rem; color:var(--muted); text-align:right; }
    @media (max-width:520px){
      .wrap{ margin:18px; padding:12px; }
      .card{ padding:18px; }
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" role="main">
      <!-- Source: uploaded PDF (Refund/Cancellation policy). -->
      <!-- :contentReference[oaicite:0]{index=0} -->
      <header>
        <h1>Refund & Cancellation Policy</h1>
        <p class="meta">Effective Date: <strong>1st October 2025</strong></p>
      </header>

      <section>
        <p>We aim to provide reliable driving lessons and fair service. This policy explains when you’re eligible for refunds, how to request them, and how we handle cancellations.</p>
      </section>
        <section>
        <p>Under UK law, for services purchased online, you have a 14-day cooling-off period during which
you may cancel and receive a refund for services not yet performed, minus any costs for services
already delivered. (Consumer Contracts Regulations)</p>
      </section>
        <section>
        <p>However, once a lesson has begun, or you’ve used part of a service, you’re not entitled to a refund for
that portion.</p>
      </section>

      <section>
        <!-- <h2>Key terms</h2> -->
        <ul>
          <li><strong>Lesson / Session</strong> — a scheduled driving lesson with an instructor.</li>
          <li><strong>Block Booking / Package</strong> — multiple lessons purchased together under one agreement.</li>
          <li><strong>Deposit / Booking Fee</strong> — a non-refundable amount in some cases unless otherwise stated.</li>
        </ul>
      </section>

      <section>
        <!-- <h2>Consumer cooling-off period</h2> -->
            <p>To cancel or reschedule a lesson, you must provide at least 48 hours’ notice before the scheduled
    start time (this is a common practice in driving schools).</p>
            <p> If you cancel within the 48-hour window, the lesson fee may be forfeited, or deducted from your block
    package.</p>
    <p> For cancellations made with proper notice, you may be offered:</p>
    <p>Rescheduling free of charge
    A full refund (if no part of the service has begun)</p>
      </section>

      <section>
        <h2>Cancellations & rescheduling</h2>
        <p>
            If you booked a block package and wish to cancel before any lessons are taken, you may request a
            refund of the unused portion, minus any deposit or administrative fees.
            If you cancel after some lessons have been taken, you will be charged at the standard pay-as-yougo rate for the lessons completed, and refunded the balance (within 30 days) of the unused portion.
            Any refund will be made to the original payment method used (credit card, bank, etc.).
        </p>
        <p> If an instructor cancels a lesson (due to illness, emergency, or mechanical issues), we
            will reschedule the lesson at no extra cost.</p>
        <p>If rescheduling is not feasible, we will issue a full refund for that canceled session.
Compensation may also include credit for time lost, at our discretion.</p>
        <ul>
          <li>If you cancel within the 48-hour window, the lesson fee may be forfeited or deducted from your block package.</li>
          <li>If you cancel with proper notice, you may be offered rescheduling free of charge or a full refund (if no part of the service has begun).</li>
        </ul>
      </section>

      <section>
        <p>To request a refund or cancellation, contact us in writing (by email to [support@bookdriving.co.uk]) With:</p>
        <ul>
          <li>Your name</li>
          <li>Booking reference / invoice number</li>
          <li>Date of purchase</li>
          <li>Reason for cancellation</li>
        </ul>
            <p>We will evaluate and confirm your request within 7 working days.
                Approved refunds will be processed within 10 working days to your original payment method.</p>

            <p>We may consider refunds (or partial refunds) in special circumstances (e.g. serious illness, relocation,
            bereavement) with documentary evidence. Such cases will be handled on a case-by-case basis.</p>
            <p>Unused lessons must be booked or used within 12 months from the date of purchase unless
                otherwise agreed.<br>
                After expiry, no refunds or extensions will be granted, unless under special circumstances.</p>
        </section>

      <section>
        <!-- <h2>General</h2>
        <p>Any refund will be made to the original payment method used (credit card, bank, etc.).</p> -->
        <p class="note">We may update this policy occasionally. The version posted on our website (with the effective date) will always apply.</p>
      </section>

      <!-- <footer aria-label="policy-source">Source document: uploaded policy file. :contentReference[oaicite:1]{index=1}</footer> -->
    </div>
  </div>
@endsection