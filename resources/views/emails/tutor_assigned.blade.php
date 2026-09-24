<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Student Assigned</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h2 {
      font-size: 22px;
      color: #444;
    }
    p {
      font-size: 16px;
      line-height: 1.6;
    }
    .details {
      margin: 20px 0;
      font-size: 16px;
    }
    .details strong {
      color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <p>Dear {{ $tutor->name }},</p>
    <p>You have been assigned a new student.</p>
    <div class="details">
      <p><strong>Student Name:</strong> {{ $student->name }}</p>
      <p><strong>Contact Email:</strong> {{ $student->email }}</p>
      <p><strong>Contact Number:</strong> {{ $student->mobile }}</p>
    </div>
    <p>Please check your dashboard for more details.</p>
    <p>Best regards,</p>
    <p>Your Team</p>
  </div>
</body>
</html>
