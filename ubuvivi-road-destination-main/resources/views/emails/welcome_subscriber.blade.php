<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ubuvivi Tours Newsletter</title>
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
        .header-brand-name { font-size:22px; font-weight:800; color:#fff; letter-spacing:.5px; line-height:1.1; text-align:left; }
        .header-brand-sub { font-size:12px; color:#C85A2A; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; text-align:left; }
        .header-tagline { font-size:13px; color:rgba(255,255,255,.55); margin-top:8px; }
        .badge-bar { background:#f7f8fb; padding:18px 32px; border-bottom:1px solid #eee; }
        .status-badge { display:inline-flex; align-items:center; gap:7px; background:#15803d; color:#fff; padding:7px 18px; border-radius:50px; font-size:13px; font-weight:700; letter-spacing:.4px; }
        .email-content { padding:36px 32px 28px; }
        .greeting { font-size:21px; font-weight:700; color:#0D1F35; margin-bottom:12px; }
        .message-text { font-size:14px; color:#555; line-height:1.85; margin-bottom:24px; }
        .message-text strong { color:#0D1F35; }
        .info-box { background:#f4f6f8; border-left:4px solid #C85A2A; border-radius:8px; padding:20px 22px; margin-bottom:28px; }
        .info-box-title { font-weight:700; color:#0D1F35; font-size:14px; margin-bottom:10px; }
        .info-box-body { font-size:13.5px; color:#555; line-height:1.8; }
        .cta-wrap { text-align:center; margin:28px 0; }
        .cta-btn { display:inline-block; background:#C85A2A; color:#fff !important; text-decoration:none; padding:15px 44px; border-radius:50px; font-size:15px; font-weight:700; letter-spacing:.3px; }
        .divider { height:1px; background:#eee; margin:24px 0; }
        .email-footer { background:#0D1F35; padding:32px; color:rgba(255,255,255,.7); font-size:13px; }
        .footer-top { display:flex; align-items:center; gap:12px; margin-bottom:22px; padding-bottom:20px; border-bottom:1px solid rgba(255,255,255,.12); }
        .footer-brand-name { font-size:16px; font-weight:700; color:#fff; line-height:1.2; }
        .footer-brand-sub { font-size:11px; color:#C85A2A; font-weight:600; letter-spacing:1px; text-transform:uppercase; }
        .footer-contact-row { margin-bottom:7px; }
        .footer-contact-row a { color:#C85A2A; text-decoration:none; }
        .footer-copy { margin-top:18px; font-size:11px; color:rgba(255,255,255,.35); line-height:1.7; }
        @media (max-width:600px) {
            .email-wrap { margin:0; border-radius:0; }
            .email-content, .email-footer, .badge-bar { padding-left:20px; padding-right:20px; }
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
                    <div>
                        <div class="header-brand-name">Ubuvivi Tours</div>
                        <div class="header-brand-sub">& Logistics</div>
                    </div>
                </div>
                <div class="header-tagline">Your Journey Starts Here &mdash; Rwanda &amp; Beyond</div>
            </div>
        </div>

        <div class="badge-bar">
            <span class="status-badge">&#10003;&nbsp; Subscription Confirmed</span>
        </div>

        <div class="email-content">
            <div class="greeting">Welcome to Ubuvivi Tours!</div>

            <p class="message-text">
                You have successfully subscribed to the <strong>Ubuvivi Tours &amp; Logistics</strong> newsletter.
                We're excited to have you with us!
            </p>

            <div class="info-box">
                <div class="info-box-title">&#127881;&nbsp; What to expect</div>
                <div class="info-box-body">
                    As a subscriber, you will receive:<br><br>
                    &bull; <strong>New blog posts</strong> &mdash; travel tips, destination guides &amp; tour highlights<br>
                    &bull; <strong>Exclusive offers</strong> &mdash; special deals on tours, car rentals &amp; transfers<br>
                    &bull; <strong>Travel updates</strong> &mdash; news from Rwanda and beyond
                </div>
            </div>

            <div class="cta-wrap">
                <a href="{{ url('/') }}" class="cta-btn">Explore Our Services &rarr;</a>
            </div>

            <div class="divider"></div>

            <p style="font-size:13px;color:#888;text-align:center;">
                If you did not subscribe, you can safely ignore this email.
            </p>
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
            <div class="footer-copy">
                &copy; {{ date('Y') }} Ubuvivi Tours &amp; Logistics. All rights reserved.
            </div>
        </div>

    </div>
</body>
</html>
