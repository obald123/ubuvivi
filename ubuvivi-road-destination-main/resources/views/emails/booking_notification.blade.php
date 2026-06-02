<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking - Ubuvivi Tours Admin</title>
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
        .info-table { width:100%; border-collapse:collapse; margin:16px 0; }
        .info-table td { padding:10px 12px; font-size:13px; border-bottom:1px solid #f0f0f0; vertical-align:top; }
        .info-table td:first-child { color:#888; width:38%; white-space:nowrap; }
        .info-table td:last-child { font-weight:600; color:#1a1a1a; }
        .divider { border:none; border-top:1px solid #ececec; margin:24px 0; }
        .btn-wrap { text-align:center; margin:24px 0; }
        .btn { display:inline-block; background:#C85A2A; color:#fff !important; text-decoration:none; padding:13px 36px; font-size:14px; font-weight:700; }
        .footer { background:#0D1F35; padding:22px 32px; }
        .footer p { font-size:12px; color:rgba(255,255,255,.6); margin:0 0 4px; line-height:1.6; }
        .footer a { color:#C85A2A; text-decoration:none; }
        @media (max-width:600px) {
            .wrap { margin:0; border:none; }
            .header, .body { padding:20px; }
            .footer { padding:20px; }
            .info-table td:first-child { width:auto; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="top-bar"></div>

    <div class="header">
        <img src="{{ asset('assets/images/logos.jpg') }}" alt="Ubuvivi Tours">
        <div>
            <div class="header-brand">Ubuvivi Tours &amp; Travel</div>
            <div class="header-sub">Admin Notification</div>
        </div>
    </div>

    <div class="body">
        <div class="subject-line">New Booking Request</div>

        <p>A new booking has been submitted and is waiting for your review.</p>

        <table class="info-table">
            <tr>
                <td>Customer</td>
                <td>{{ $booking->name ?? $booking->names }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><a href="mailto:{{ $booking->email }}" style="color:#C85A2A;">{{ $booking->email }}</a></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $booking->phone_number }}</td>
            </tr>
            @if($booking->check_in ?? false)
            <tr>
                <td>Check-in</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td>Check-out</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
            </tr>
            @endif
            @if($booking->departure_date ?? false)
            <tr>
                <td>Route</td>
                <td>{{ $booking->departure_airport ?? '' }} &rarr; {{ $booking->arrival_airport ?? '' }}</td>
            </tr>
            <tr>
                <td>Departure</td>
                <td>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</td>
            </tr>
            @endif
            @if($booking->message ?? false)
            <tr>
                <td>Notes</td>
                <td>{{ $booking->message }}</td>
            </tr>
            @endif
            <tr>
                <td>Submitted</td>
                <td>{{ $booking->created_at ? $booking->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>Pending Review</td>
            </tr>
        </table>

        <div class="btn-wrap">
            <a href="{{ $link }}" class="btn">Review Booking</a>
        </div>

        <hr class="divider">

        <p style="font-size:13px;color:#888;">Please respond to this booking promptly. Log in to the admin dashboard to approve, reject, or contact the customer.</p>
    </div>

    <div class="footer">
        <p>Ubuvivi Tours &amp; Travel &mdash; Remera, Kigali, Rwanda</p>
        <p><a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a> &nbsp;|&nbsp; <a href="https://ubuvivitours.com">ubuvivitours.com</a></p>
        <p style="margin-top:10px;color:rgba(255,255,255,.35);">&copy; {{ date('Y') }} Ubuvivi Tours &amp; Travel. Admin notification &mdash; Booking #{{ $booking->id }}</p>
    </div>
</div>
</body>
</html>
