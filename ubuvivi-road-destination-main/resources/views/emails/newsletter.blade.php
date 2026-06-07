<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }} - Ubuvivi Tours</title>
    <style>
        body { margin:0; padding:0; background:#f4f4f4; font-family:Arial, sans-serif; color:#333; }
        .wrap { max-width:580px; margin:28px auto; background:#fff; border:1px solid #e0e0e0; }
        .top-bar { height:4px; background:#C85A2A; }
        .header { padding:24px 32px; border-bottom:1px solid #ececec; display:flex; align-items:center; gap:14px; }
        .header img { height:44px; width:auto; object-fit:contain; }
        .header-brand { font-size:17px; font-weight:700; color:#0D1F35; line-height:1.2; }
        .header-sub { font-size:11px; color:#888; text-transform:uppercase; letter-spacing:1px; margin-top:2px; }
        .body { padding:32px; }
        .subject-line { font-size:18px; font-weight:700; color:#0D1F35; margin-bottom:20px; }
        .newsletter-body { font-size:14px; color:#444; line-height:1.8; white-space:pre-line; }
        .divider { border:none; border-top:1px solid #ececec; margin:28px 0; }
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
            <div class="header-sub">Newsletter</div>
        </div>
    </div>

    <div class="body">
        <div class="subject-line">{{ $subject }}</div>
        <div class="newsletter-body">{{ $body }}</div>

        <hr class="divider">

        <p style="font-size:12px;color:#aaa;">You are receiving this email because you subscribed to Ubuvivi Tours newsletters. If you no longer wish to receive these, please contact us.</p>
    </div>

    <div class="footer">
        <p>Ubuvivi Tours &amp; Travel &mdash; Remera, Kigali, Rwanda</p>
        <p><a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a> &nbsp;|&nbsp; <a href="https://ubuvivitours.com">ubuvivitours.com</a></p>
        <p style="margin-top:10px;color:rgba(255,255,255,.35);">&copy; {{ date('Y') }} Ubuvivi Tours &amp; Travel. All rights reserved.</p>
    </div>
</div>
</body>
</html>
