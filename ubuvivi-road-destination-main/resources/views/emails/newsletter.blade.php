<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }} - Ubuvivi Tours</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Poppins', Arial, sans-serif; background-color:#f0f2f5; color:#333; line-height:1.6; }
        .email-wrap { max-width:620px; margin:32px auto; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(13,31,53,.14); background:#fff; }
        .email-header { background:#0D1F35; padding:0; text-align:center; }
        .header-top-bar { background:#C85A2A; height:5px; }
        .header-inner { padding:36px 32px 32px; }
        .header-logo-wrap { display:inline-flex; align-items:center; gap:14px; margin-bottom:10px; }
        .header-logo-img { width:56px; height:56px; border-radius:50%; background:#fff; padding:4px; object-fit:contain; }
        .header-brand { text-align:left; }
        .header-brand-name { font-size:22px; font-weight:800; color:#fff; letter-spacing:.5px; line-height:1.1; }
        .header-brand-sub { font-size:12px; color:#C85A2A; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; }
        .header-tagline { font-size:13px; color:rgba(255,255,255,.55); margin-top:8px; }
        .badge-bar { background:#f7f8fb; padding:18px 32px; border-bottom:1px solid #eee; }
        .status-badge { display:inline-flex; align-items:center; gap:7px; background:#C85A2A; color:#fff; padding:7px 18px; border-radius:50px; font-size:13px; font-weight:700; letter-spacing:.4px; }
        .email-content { padding:36px 32px 28px; }
        .greeting { font-size:21px; font-weight:700; color:#0D1F35; margin-bottom:12px; }
        .newsletter-body { font-size:14px; color:#555; line-height:1.85; margin-bottom:28px; white-space:pre-line; }
        .divider { height:1px; background:#eee; margin:24px 0; }
        .unsubscribe-note { font-size:12px; color:#aaa; text-align:center; margin-top:16px; }
        .email-footer { background:#0D1F35; padding:32px; color:rgba(255,255,255,.7); font-size:13px; }
        .footer-top { display:flex; align-items:center; gap:12px; margin-bottom:22px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,.12); }
        .footer-brand-name { font-size:16px; font-weight:700; color:#fff; line-height:1.2; }
        .footer-brand-sub { font-size:11px; color:#C85A2A; font-weight:600; letter-spacing:1px; text-transform:uppercase; }
        .footer-contact-row { margin-bottom:7px; }
        .footer-contact-row a { color:#C85A2A; text-decoration:none; }
        .footer-social { margin-top:18px; padding-top:18px; border-top:1px solid rgba(255,255,255,.10); }
        .footer-social a { display:inline-block; margin-right:12px; color:rgba(255,255,255,.6); text-decoration:none; font-size:12px; font-weight:600; }
        .footer-copy { margin-top:18px; font-size:11px; color:rgba(255,255,255,.35); line-height:1.7; }
        @media (max-width:600px) {
            .email-wrap { margin:0; border-radius:0; }
            .email-content, .email-footer, .badge-bar { padding-left:20px; padding-right:20px; }
            .header-inner { padding:28px 20px 24px; }
        }
    </style>
</head>
<body>
    <div class="email-wrap">

        <div class="email-header">
            <div class="header-top-bar"></div>
            <div class="header-inner">
                <div class="header-logo-wrap">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Ubuvivi Tours" class="header-logo-img">
                    <div class="header-brand">
                        <div class="header-brand-name">Ubuvivi Tours</div>
                        <div class="header-brand-sub">& Logistics</div>
                    </div>
                </div>
                <div class="header-tagline">Your Journey Starts Here &mdash; Rwanda &amp; Beyond</div>
            </div>
        </div>

        <div class="badge-bar">
            <span class="status-badge">&#9993;&nbsp; Newsletter</span>
        </div>

        <div class="email-content">
            <div class="greeting">{{ $subject }}</div>
            <div class="newsletter-body">{{ $body }}</div>
            <div class="divider"></div>
            <p class="unsubscribe-note">You are receiving this email because you subscribed to Ubuvivi Tours newsletters.</p>
        </div>

        <div class="email-footer">
            <div class="footer-top">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width:38px;height:38px;border-radius:50%;background:#fff;padding:3px;object-fit:contain;">
                <div>
                    <div class="footer-brand-name">Ubuvivi Tours &amp; Logistics</div>
                    <div class="footer-brand-sub">Kigali, Rwanda</div>
                </div>
            </div>
            <div class="footer-contact-row">&#128205; Remera - Kisimenti KG11 Ave, Amahoro Stadium Road, Ikaze House, 3rd Floor, Kigali</div>
            <div class="footer-contact-row">&#128231; <a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a></div>
            <div class="footer-contact-row">&#127760; <a href="https://ubuvivitours.com">ubuvivitours.com</a></div>
            <div class="footer-social">
                <a href="https://facebook.com">Facebook</a>
                <a href="https://instagram.com">Instagram</a>
                <a href="https://twitter.com">Twitter</a>
            </div>
            <div class="footer-copy">
                &copy; {{ date('Y') }} Ubuvivi Tours &amp; Logistics. All rights reserved.<br>
                This is a newsletter from Ubuvivi Tours. Please do not reply directly to this email.
            </div>
        </div>

    </div>
</body>
</html>
