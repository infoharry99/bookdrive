<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New User Registration</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffff;
      margin: 0;
      padding: 0;
      color: #444;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 30px 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      text-align: center;
    }
    .logo {
      max-width: 155px;
      height: auto;
      margin-bottom: 20px;
    }
    .headline {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }
    .content {
      text-align: left;
      font-size: 16px;
      line-height: 1.6;
      color: #444;
    }
    .content b {
      color: #222;
    }
    .cta-button {
      display: inline-block;
      margin-top: 30px;
      padding: 15px 30px;
      background-color: #674299;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      font-size: 18px;
    }
    .footer {
      margin-top: 40px;
      font-size: 14px;
      color: #777;
    }
    @media only screen and (max-width: 480px) {
      .container {
        width: 90% !important;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="https://bookdriver.sofinish.co.uk/frontendnew/img/logo2.png" alt="My Choice Tutor Logo" class="logo">
    
    <div class="headline">Welcome !</div>
    
    <div class="content">
      <p><b>Dear Sir,</b></p>
      <p>A new user has just registered. Below are the user details:</p>
      
      <p><b>Username:</b> {{ $name }}</p>
      <p><b>Mobile:</b> {{ $phone }}</p>
      <p><b>Email:</b> {{ $email }}</p>
      <p><b>Class Purchased:</b> {{ $classpuchased }} Hour</p>
      <p><b>Postcode:</b> {{ $postcode }}</p>
       <p><b>Driving License:</b> {{ $theory_certificate }}</p>
        <p><b>Theory Certificate Number:</b> {{ $licence }}</p>
         <p><b>Practical Test Centre:</b> {{ $practical_test_centre }}</p>
      <p><b>Transaction ID:</b> {{ $transaction_id }}</p>
      <p><b>Total Amount:</b> {{ $total_amount }}</p>
    </div>

    <a href="https://bookdriver.sofinish.co.uk/" class="cta-button">Visit Account and Start Managing</a>

    <div class="footer">
      <!--<p>For any query, feel free to contact us at <b>07761 975326</b></p>-->
    </div>
  </div>
</body>
</html>
