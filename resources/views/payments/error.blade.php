<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Error</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      text-align: center;
      max-width: 400px;
      background-color: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .icon {
      font-size: 64px;
      color: #e74c3c;
    }

    h1 {
      font-size: 28px;
      color: #333;
      margin: 20px 0 10px;
    }

    p {
      color: #666;
      margin-bottom: 20px;
    }

    .btn {
      padding: 12px 20px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      background-color: #3498db;
      color: #fff;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon">⚠️</div>
    <h1>Something Went Wrong</h1>
    <p>We’re sorry, but an unexpected error has occurred.<br>Please try again later.</p>
    <button class="btn" onclick="window.location.href='/'">Back to Home</button>
  </div>
</body>
</html>
