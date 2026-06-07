<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Update - Ubuvivi Tours</title>
    <style>
        body { margin:0; padding:0; background:#f4f4f4; font-family:Arial, sans-serif; color:#333; }
        .wrap { max-width:580px; margin:28px auto; background:#fff; border:1px solid #e0e0e0; }
        .top-bar { height:4px; background:{{ $approved ? '#16a34a' : '#dc2626' }}; }
        .header { padding:24px 32px; border-bottom:1px solid #ececec; display:flex; align-items:center; gap:14px; }
        .header img { height:44px; width:auto; object-fit:contain; }
        .header-brand { font-size:17px; font-weight:700; color:#0D1F35; line-height:1.2; }
        .header-sub { font-size:11px; color:#888; text-transform:uppercase; letter-spacing:1px; margin-top:2px; }
        .body { padding:32px; }
        .subject-line { font-size:18px; font-weight:700; color:#0D1F35; margin-bottom:16px; }
        .body p { font-size:14px; color:#444; line-height:1.75; margin:0 0 16px; }
        .status-box { border-left:4px solid {{ $approved ? '#16a34a' : '#dc2626' }}; background:{{ $approved ? '#f0fdf4' : '#fef2f2' }}; padding:14px 18px; margin:20px 0; font-size:14px; color:{{ $approved ? '#15803d' : '#991b1b' }}; font-weight:600; }
        .divider { border:none; border-top:1px solid #ececec; margin:24px 0; }
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
            <div class="header-sub">Booking Update</div>
        </div>
    </div>

    <div class="body">
        <div class="subject-line">
            @if($approved)
                Your Booking Has Been Approved
            @else
                Your Booking Could Not Be Confirmed
            @endif
        </div>

        <p>Dear {{ $names }},</p>

        @if($approved)
            <div class="status-box">Your booking has been approved.</div>
            <p>We are pleased to confirm your booking. Our team will be in touch with you shortly to provide further details, payment information, and any next steps needed to complete your arrangement.</p>
        @else
            <div class="status-box">Unfortunately, your booking could not be confirmed at this time.</div>
            <p>We are sorry that we could not accommodate your request. This may be due to availability or other constraints. Please contact us and we will do our best to find an alternative for you.</p>
        @endif

        @if($link)
        <div class="btn-wrap">
            <a href="{{ $link }}" class="btn">View My Booking</a>
        </div>
        @endif

        <hr class="divider">

        <p style="font-size:13px;color:#888;">For questions or assistance, contact us at <a href="mailto:ubuvivitours@gmail.com" style="color:#C85A2A;">ubuvivitours@gmail.com</a> or call +250 789 044 222.</p>
    </div>

    <div class="footer">
        <p>Ubuvivi Tours &amp; Travel &mdash; Remera, Kigali, Rwanda</p>
        <p><a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a> &nbsp;|&nbsp; <a href="https://ubuvivitours.com">ubuvivitours.com</a></p>
        <p style="margin-top:10px;color:rgba(255,255,255,.35);">&copy; {{ date('Y') }} Ubuvivi Tours &amp; Travel. All rights reserved.</p>
    </div>
</div>
</body>
</html>
