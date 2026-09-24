<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment Pending</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f1f5f9;
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
      color: #f1c40f;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.1); opacity: 0.7; }
      100% { transform: scale(1); opacity: 1; }
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
      transition: 0.3s ease;
      background-color: #3498db;
      color: white;
    }

    .btn:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon">⏳</div>
    <h1>Payment Pending</h1>
    <p>Your payment is being processed. This may take a few moments.</p>
    <div class="details">
      Transaction ID: #1234567890<br>
      Status: Awaiting confirmation from bank
    </div>
    <button class="btn" onclick="window.location.reload()">Refresh Status</button>
  </div>
</body>
</html>
