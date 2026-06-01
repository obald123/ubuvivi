<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Alert - Ubuvivi Tours</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Poppins', Arial, sans-serif; background-color:#f0f2f5; color:#333; line-height:1.6; }
        .email-wrap { max-width:620px; margin:32px auto; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(13,31,53,.14); background:#fff; }

        /* Header */
        .email-header { background:#0D1F35; padding:0; text-align:center; }
        .header-top-bar { background:#C85A2A; height:5px; }
        .header-inner { padding:36px 32px 32px; }
        .header-logo-wrap { display:inline-flex; align-items:center; gap:14px; margin-bottom:10px; }
        .header-logo-img { width:56px; height:56px; border-radius:50%; background:#fff; padding:4px; object-fit:contain; }
        .header-brand { text-align:left; }
        .header-brand-name { font-size:22px; font-weight:800; color:#fff; letter-spacing:.5px; line-height:1.1; }
        .header-brand-sub { font-size:12px; color:#C85A2A; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; }
        .header-tagline { font-size:13px; color:rgba(255,255,255,.55); margin-top:8px; }

        /* Badge bar */
        .badge-bar { background:#f7f8fb; padding:18px 32px; border-bottom:1px solid #eee; }
        .status-badge { display:inline-flex; align-items:center; gap:7px; background:#e74c3c; color:#fff; padding:7px 18px; border-radius:50px; font-size:13px; font-weight:700; letter-spacing:.4px; }

        /* Content */
        .email-content { padding:36px 32px 28px; }
        .greeting { font-size:21px; font-weight:700; color:#0D1F35; margin-bottom:12px; }
        .message-text { font-size:14px; color:#555; line-height:1.85; margin-bottom:24px; }
        .message-text strong { color:#0D1F35; }

        /* Detail card */
        .detail-card { background:#f4f6f8; border-left:4px solid #C85A2A; border-radius:8px; padding:20px 22px; margin-bottom:24px; }
        .detail-card-title { font-weight:700; color:#0D1F35; font-size:14px; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
        .detail-row { display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; }
        .detail-row:last-child { margin-bottom:0; }
        .detail-label { font-size:12px; color:#888; font-weight:600; text-transform:uppercase; letter-spacing:.4px; min-width:110px; padding-top:2px; }
        .detail-value { font-size:14px; color:#222; font-weight:600; flex:1; }

        /* CTA */
        .cta-wrap { text-align:center; margin:28px 0; }
        .cta-btn { display:inline-block; background:#C85A2A; color:#fff !important; text-decoration:none; padding:15px 44px; border-radius:50px; font-size:15px; font-weight:700; letter-spacing:.3px; }

        /* Next steps */
        .next-steps { background:#f0f5ff; border-radius:8px; padding:18px 20px; margin-bottom:24px; }
        .next-steps-title { font-weight:700; color:#0D1F35; margin-bottom:10px; font-size:14px; }
        .next-steps ul { margin:0; padding-left:20px; font-size:13px; color:#444; line-height:1.9; }

        /* Note */
        .note-strip { background:#fff8f4; border:1px solid #f5d5c2; border-radius:8px; padding:14px 18px; font-size:13px; color:#7a3815; line-height:1.7; margin-bottom:24px; }
        .note-strip strong { color:#C85A2A; }

        .divider { height:1px; background:#eee; margin:24px 0; }

        /* Footer */
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
            .header-inner { padding:28px 20px 24px; }
            .detail-row { flex-direction:column; gap:2px; }
            .detail-label { min-width:auto; }
            .cta-btn { padding:14px 32px; }
        }
    </style>
</head>
<body>
    <div class="email-wrap">

        <!-- Header -->
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
                <div class="header-tagline">Admin Notification &mdash; New Booking Received</div>
            </div>
        </div>

        <!-- Badge -->
        <div class="badge-bar">
            <span class="status-badge">&#9888;&nbsp; New Booking Alert</span>
        </div>

        <!-- Content -->
        <div class="email-content">
            <div class="greeting">New Booking Request</div>

            <p class="message-text">
                A new booking has been submitted through <strong>Ubuvivi Tours &amp; Logistics</strong>
                and is awaiting your review. Please check the details below and take action promptly.
            </p>

            <!-- Booking Details -->
            <div class="detail-card">
                <div class="detail-card-title">&#128203;&nbsp; Customer Details</div>

                <div class="detail-row">
                    <span class="detail-label">Full Name</span>
                    <span class="detail-value">{{ $booking->name ?? $booking->names }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">
                        <a href="mailto:{{ $booking->email }}" style="color:#C85A2A;text-decoration:none;">{{ $booking->email }}</a>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone</span>
                    <span class="detail-value">{{ $booking->phone_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Booking #</span>
                    <span class="detail-value">#{{ $booking->id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Submitted</span>
                    <span class="detail-value">{{ date('jS F, Y \a\t h:i A', strtotime($booking->created_at ?? now())) }}</span>
                </div>

                @if($booking->check_in ?? false)
                <div style="height:1px;background:#e0e4ea;margin:14px 0;"></div>
                <div class="detail-row">
                    <span class="detail-label">Check-in</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Check-out</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</span>
                </div>
                @if($booking->number_of_guests ?? false)
                <div class="detail-row">
                    <span class="detail-label">Guests</span>
                    <span class="detail-value">{{ $booking->number_of_guests }}</span>
                </div>
                @endif
                @if($booking->room_type ?? false)
                <div class="detail-row">
                    <span class="detail-label">Room Type</span>
                    <span class="detail-value">{{ $booking->room_type }}</span>
                </div>
                @endif
                @endif

                @if($booking->departure_date ?? false)
                <div style="height:1px;background:#e0e4ea;margin:14px 0;"></div>
                <div class="detail-row">
                    <span class="detail-label">Route</span>
                    <span class="detail-value">{{ $booking->departure_airport ?? '—' }} → {{ $booking->arrival_airport ?? '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Departure</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($booking->departure_date)->format('M d, Y') }}</span>
                </div>
                @if($booking->number_of_passengers ?? false)
                <div class="detail-row">
                    <span class="detail-label">Passengers</span>
                    <span class="detail-value">{{ $booking->number_of_passengers }}</span>
                </div>
                @endif
                @endif

                @if($booking->message ?? false)
                <div style="height:1px;background:#e0e4ea;margin:14px 0;"></div>
                <div class="detail-row">
                    <span class="detail-label">Notes</span>
                    <span class="detail-value" style="font-weight:400;color:#555;">{{ $booking->message }}</span>
                </div>
                @endif
            </div>

            <!-- CTA -->
            <div class="cta-wrap">
                <a href="{{ $link }}" class="cta-btn">View &amp; Manage Booking &rarr;</a>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <div class="next-steps-title">&#128205;&nbsp; Next Steps</div>
                <ul>
                    <li>Review the booking details carefully</li>
                    <li>Check availability and confirm with the supplier if needed</li>
                    <li>Contact the customer if additional information is required</li>
                    <li>Approve or update the booking status in the dashboard</li>
                </ul>
            </div>

            <div class="note-strip">
                <strong>Reminder:</strong> Customers expect a response within 24 hours. Prompt action
                ensures the best experience and reduces booking cancellations.
            </div>
        </div>

        <!-- Footer -->
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
                &copy; {{ date('Y') }} Ubuvivi Tours &amp; Logistics. All rights reserved.<br>
                This is an automated admin notification. Booking ID: #{{ $booking->id }}
            </div>
        </div>

    </div>
</body>
</html>
