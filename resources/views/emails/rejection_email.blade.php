<!-- resources/views/emails/rejection_email.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Job Application Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333333;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h2 {
            color: #dc3545; /* Bootstrap danger red */
            margin-top: 0;
        }
        p {
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #666666;
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Job Application Update</h2>

        <p>Dear {{ $applicantName }},</p>

        <p>Thank you for your interest in the <strong>{{ $jobName }}</strong> position</p>

        <p>After careful consideration, we regret to inform you that we will not be moving forward with your application at this time.</p>

        <p>We appreciate your effort and encourage you to apply for other opportunities with us in the future.</p>

        <p>Wishing you all the best in your job search.</p>

        <p>Sincerely,<br>
        The Recruitment Team</p>

        <div class="footer">
           &copy; {{ date('Y') }} JobConnect. All rights reserved.
        </div>
    </div>
</body>
</html>
