<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Ubuvivi Tours</title>
    <style>
        body { margin:0; padding:0; background:#f0f2f5; font-family:'Helvetica Neue',Arial,sans-serif; color:#333; }
        .outer { padding:40px 16px; }
        .wrap { max-width:560px; margin:0 auto; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,.08); }

        /* Header */
        .header { padding:32px 40px 24px; text-align:center; border-bottom:1px solid #f0f0f0; }
        .header img { height:70px; width:70px; border-radius:50%; object-fit:cover; display:block; margin:0 auto 12px; }
        .header-brand { font-size:18px; font-weight:700; color:#1a1a2e; letter-spacing:.2px; }
        .header-sub { font-size:12px; color:#aaa; text-transform:uppercase; letter-spacing:1px; margin-top:3px; }

        /* Body */
        .body { padding:32px 40px; }
        .subject-line { font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:14px; }
        .body p { font-size:15px; color:#555; line-height:1.8; margin:0 0 14px; }
        .divider { border:none; border-top:1px solid #f0f0f0; margin:24px 0; }

        /* Highlight box */
        .highlight { background:#fafafa; border-left:3px solid #C85A2A; border-radius:0 6px 6px 0; padding:14px 18px; margin:20px 0; font-size:14px; color:#555; line-height:1.75; }

        /* Button */
        .btn-wrap { text-align:center; margin:28px 0 20px; }
        .btn { display:inline-block; background:#C85A2A; color:#fff !important; text-decoration:none; padding:14px 40px; font-size:15px; font-weight:700; border-radius:6px; letter-spacing:.3px; }

        /* Footer */
        .footer { padding:20px 40px 28px; text-align:center; }
        .footer p { font-size:12px; color:#bbb; margin:0 0 4px; line-height:1.7; }
        .footer a { color:#C85A2A; text-decoration:none; }

        @media (max-width:600px) {
            .outer { padding:20px 0; }
            .wrap { border-radius:0; box-shadow:none; }
            .header, .body, .footer { padding-left:24px; padding-right:24px; }
        }
    </style>
</head>
<body>
<div class="outer">
<div class="wrap">

    <div class="header">
        <img src="{{ asset('img/android-chrome-512x512.png?v=1') }}" alt="Ubuvivi Tours">
        <div class="header-brand">Ubuvivi Tours &amp; Travel</div>
        <div class="header-sub">Kigali, Rwanda</div>
    </div>

    <div class="body">
        <div class="subject-line">Booking Received</div>

        <p>Thank you for your booking. We have received your request and our team will review it and get back to you within <strong>24 hours</strong>.</p>

        <div class="highlight">
            To view your booking details and track its status, click the button below. Keep this link &mdash; it is unique to your booking.
        </div>

        <div class="btn-wrap">
            <a href="{{ $link }}" class="btn">View My Booking</a>
        </div>

        <hr class="divider">

        <p style="font-size:13px;color:#aaa;text-align:center;">If you have any questions, contact us at <a href="mailto:ubuvivitours@gmail.com" style="color:#C85A2A;">ubuvivitours@gmail.com</a> or call +250 789 044 222.</p>
    </div>

    <div class="footer">
        <p>Ubuvivi Tours &amp; Travel &mdash; Remera, Kigali, Rwanda</p>
        <p><a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a> &nbsp;&bull;&nbsp; <a href="https://ubuvivitours.com">ubuvivitours.com</a></p>
        <p style="margin-top:8px;">&copy; {{ date('Y') }} Ubuvivi Tours &amp; Travel. All rights reserved.</p>
    </div>

</div>
</div>
</body>
</html>
