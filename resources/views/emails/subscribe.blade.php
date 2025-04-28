<!DOCTYPE html>
<html>
<head>
    <title>Subscription Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 30px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dear {{ $name }},</h1>

        <p>Thank you for subscribing to <strong>JobConnect</strong>!</p>
        
        <p>We truly appreciate your support. Stay tuned for the latest updates, job opportunities, and career resources sent directly to your inbox.</p>

        <p>If you have any questions, feel free to reply to this email — we’re here to help!</p>

        <div class="footer">
            &copy; {{ date('Y') }} JobConnect. All rights reserved.
        </div>
    </div>
</body>
</html>
