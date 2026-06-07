<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Ubuvivi Tours</title>
    <style>
        body { margin:0; padding:0; background:#f4f4f4; font-family:Arial, sans-serif; color:#333; }
        .wrap { max-width:580px; margin:28px auto; background:#fff; border:1px solid #e0e0e0; }
        .top-bar { height:4px; background:#C85A2A; }
        .header { padding:24px 32px; border-bottom:1px solid #ececec; display:flex; align-items:center; gap:14px; }
        .header img { height:44px; width:auto; object-fit:contain; }
        .header-brand { font-size:17px; font-weight:700; color:#0D1F35; line-height:1.2; }
        .header-sub { font-size:11px; color:#888; text-transform:uppercase; letter-spacing:1px; margin-top:2px; }
        .body { padding:32px; }
        .subject-line { font-size:18px; font-weight:700; color:#0D1F35; margin-bottom:16px; }
        .body p { font-size:14px; color:#444; line-height:1.75; margin:0 0 16px; }
        .divider { border:none; border-top:1px solid #ececec; margin:24px 0; }
        .highlight { background:#f9f6f4; border-left:3px solid #C85A2A; padding:14px 18px; margin:20px 0; font-size:13px; color:#444; line-height:1.7; }
        .btn-wrap { text-align:center; margin:28px 0; }
        .btn { display:inline-block; background:#C85A2A; color:#fff !important; text-decoration:none; padding:13px 36px; font-size:14px; font-weight:700; }
        .footer { background:#0D1F35; padding:22px 32px; }
        .footer p { font-size:12px; color:rgba(255,255,255,.6); margin:0 0 4px; line-height:1.6; }
        .footer a { color:#C85A2A; text-decoration:none; }
        @media (max-width:600px) {
            .wrap { margin:0; border:none; }
            .header, .body { padding:20px; }
            .footer { padding:20px; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="top-bar"></div>

    <div class="header">
        <img src="{{ asset('img/android-chrome-512x512.png?v=1') }}" alt="Ubuvivi Tours">
        <div>
            <div class="header-brand">Ubuvivi Tours &amp; Travel</div>
            <div class="header-sub">Kigali, Rwanda</div>
        </div>
    </div>

    <div class="body">
        <div class="subject-line">Booking Received</div>

        <p>Thank you for your booking. We have received your request and our team will review it and get back to you within <strong>24 hours</strong>.</p>

        <div class="highlight">
            To view your booking details and track its status, click the button below. Keep this link — it is unique to your booking.
        </div>

        <div class="btn-wrap">
            <a href="{{ $link }}" class="btn">View My Booking</a>
        </div>

        <hr class="divider">

        <p style="font-size:13px;color:#888;">If you have any questions, reply to this email or contact us at <a href="mailto:ubuvivitours@gmail.com" style="color:#C85A2A;">ubuvivitours@gmail.com</a> or call +250 789 044 222.</p>
    </div>

    <div class="footer">
        <p>Ubuvivi Tours &amp; Travel &mdash; Remera, Kigali, Rwanda</p>
        <p><a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a> &nbsp;|&nbsp; <a href="https://ubuvivitours.com">ubuvivitours.com</a></p>
        <p style="margin-top:10px;color:rgba(255,255,255,.35);">&copy; {{ date('Y') }} Ubuvivi Tours &amp; Travel. All rights reserved.</p>
    </div>
</div>
</body>
</html>
