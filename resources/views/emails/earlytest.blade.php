<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Early Driving Test Enquiry</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .header {
      text-align: center;
      padding-bottom: 20px;
    }
    .header img {
      max-width: 150px;
    }
    .content {
      text-align: left;
      color: #333;
      font-size: 16px;
      line-height: 1.6;
    }
    .content b {
      color: #222;
    }
    .footer {
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #777;
    }
    @media screen and (max-width: 480px) {
      .container {
        width: 90% !important;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="https://bookdriver.sofinish.co.uk/frontendnew/img/logo2.png" alt="Company Logo">
      <h2>Early Driving Test Enquiry Request!</h2>
    </div>

    <div class="content">
      <p><b>Dear {{ $user_name }},</b></p>
      <p>We have received your request for an early driving test.</p>

      <p><b>Request Details:</b></p>
      <p><b>Number:</b> {{ $number }}</p>
      <p><b>Email:</b> {{ $email }}</p>
      <p><b>Latest Date:</b> {{ $latest_date }}</p>
      <p><b>Test Centre:</b> {{ $test_centres }}</p>
      <p><b>Test Center 1:</b> {{ $center1 }}</p>

      @if (!empty($center2))
        <p><b>Test Center 2:</b> {{ $center2 }}</p>
      @endif

      @if (!empty($center3))
        <p><b>Test Center 3:</b> {{ $center3 }}</p>
      @endif

      <p><b>License Number:</b> {{ $license_number }}</p>
      <p><b>Theory Number:</b> {{ $theory_number }}</p>
      <p><b>Earliest Date:</b> {{ $earliest_date }}</p>

      <br>
      <p>Thank you for choosing us. We will get back to you soon!</p>
    </div>

    <div class="footer">
      <p>&copy; 2025 PropTech Kenya. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
