<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your Instructor Has Been Assigned</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #e0e0e0;
            padding: 30px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #674299;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        strong {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Instructor Assigned</h2>
        <p>Dear {{ $student->name }},</p>
        <p>We’re pleased to let you know that an instructor has been assigned to guide you through your learning journey.</p>

        <p><strong>Instructor Name:</strong> {{ $tutor->name }}</p>
        <p><strong>Contact Email:</strong> {{ $tutor->email }}</p>
        <p><strong>Contact Number:</strong> {{ $tutor->mobile }}</p>

        <p>Feel free to reach out to your instructor for support or guidance regarding your lessons.</p>

        <p>Best regards,<br>
    </div>
</body>
</html>
