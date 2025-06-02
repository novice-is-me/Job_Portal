<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Interview Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #333;">Hello, {{ $applicantName }}!</h2>

        <p style="font-size: 16px; color: #555;">
            We are pleased to inform you that you have been selected for an interview for the position of <strong>{{ $jobName }}</strong>.
        </p>

        <p style="font-size: 16px; color: #555;">
            📅 <strong>Interview Date:</strong> {{ \Carbon\Carbon::parse($interviewDate)->format('F j, Y \a\t g:i A') }}
        </p>

        <p style="font-size: 16px; color: #555;">
            Please make sure to be available on the scheduled date and time. Further details will be provided upon confirmation.
        </p>

        <p style="font-size: 16px; color: #555;">
            Best regards,<br>
            <strong>JobConnect Team</strong>
        </p>
    </div>
</body>
</html>
