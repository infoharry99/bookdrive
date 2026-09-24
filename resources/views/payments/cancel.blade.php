<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment Cancelled</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      text-align: center;
      max-width: 400px;
      width: 90%;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .icon {
      font-size: 60px;
      color: #e67e22;
    }

    h1 {
      color: #333;
      margin-top: 20px;
    }

    p {
      color: #666;
      margin: 10px 0 20px;
    }

    .btn {
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease;
      margin: 5px;
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
      background-color: #d0d3d4;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon">🚫</div>
    <h1>Payment Cancelled</h1>
    <p>You’ve cancelled the payment process. No charges were made.</p>
    <button class="btn btn-primary" onclick="window.location.href='/retry'">Try Again</button>
    <button class="btn btn-secondary" onclick="window.location.href='/'">Go to Home</button>
  </div>
</body>
</html>
