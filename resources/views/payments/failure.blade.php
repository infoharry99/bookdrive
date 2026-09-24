<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment Failed</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
      width: 90%;
    }

    .icon {
      font-size: 60px;
      color: #e74c3c;
    }

    h1 {
      color: #333;
      margin-top: 20px;
    }

    p {
      color: #666;
      margin: 10px 0 20px;
    }

    .details {
      font-size: 0.9rem;
      color: #999;
      margin-bottom: 20px;
    }

    .btn {
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin: 5px;
      transition: 0.3s ease;
    }

    .btn-primary {
      background-color: #3498db;
      color: white;
    }

    .btn-primary:hover {
      background-color: #2980b9;
    }

    .btn-secondary {
      background-color: #ecf0f1;
      color: #333;
    }

    .btn-secondary:hover {
      background-color: #dcdde1;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon">❌</div>
    <h1>Payment Failed</h1>
    <p>We couldn’t process your payment. Please check your card or try again.</p>
    <div class="details">
      Transaction ID: #1234567890<br>
      Reason: Card declined by bank
    </div>
    <button class="btn btn-primary" onclick="location.reload()">Try Again</button>
    <button class="btn btn-secondary" onclick="window.location.href='/'">Go to Home</button>
  </div>
</body>
</html>
