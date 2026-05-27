<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification - Ubuvivi Tours Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .header {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            padding: 30px 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-content h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header-content p {
            font-size: 13px;
            opacity: 0.9;
        }
        .alert-badge {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }
        .content {
            padding: 40px 30px;
        }
        .booking-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #f9fafb 100%);
            border: 2px solid #e74c3c;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
        }
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #fff;
        }
        .booking-title {
            font-size: 18px;
            font-weight: 700;
            color: #c0392b;
        }
        .booking-time {
            font-size: 12px;
            color: #999;
            font-weight: 500;
        }
        .status-badge {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .booking-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-item:nth-child(n+3) {
            grid-column: 1 / -1;
        }
        .detail-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 15px;
            color: #333;
            font-weight: 500;
            word-break: break-word;
        }
        .detail-value a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 600;
        }
        .detail-value a:hover {
            text-decoration: underline;
        }
        .action-section {
            background-color: #fff5f5;
            border: 1px solid #ffebee;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .action-section p {
            font-size: 13px;
            color: #555;
            margin-bottom: 15px;
        }
        .action-button {
            display: inline-block;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white !important;
            padding: 12px 35px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s;
        }
        .action-button:hover {
            transform: translateY(-2px);
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .info-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #e74c3c;
        }
        .info-box-title {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .info-box-value {
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }
        .divider {
            height: 1px;
            background-color: #e8e8e8;
            margin: 25px 0;
        }
        .footer-section {
            background-color: #f8f9fa;
            padding: 25px 30px;
            border-top: 1px solid #e8e8e8;
            font-size: 12px;
            color: #666;
        }
        .footer-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            font-size: 13px;
        }
        .quick-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 15px 0;
        }
        .stat-item {
            background-color: #fff;
            padding: 12px;
            border-radius: 4px;
            border-left: 3px solid #e74c3c;
        }
        .stat-label {
            font-size: 11px;
            color: #999;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }
        @media (max-width: 600px) {
            .container {
                border-radius: 0;
            }
            .header {
                flex-direction: column;
                gap: 15px;
            }
            .booking-details {
                grid-template-columns: 1fr;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <h1>🎯 NEW BOOKING ALERT</h1>
                <p>Immediate action may be required</p>
            </div>
            <div class="alert-badge">⚡ PENDING REVIEW</div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Main Booking Card -->
            <div class="booking-card">
                <div class="booking-header">
                    <div>
                        <div class="booking-title">{{ $booking->name ?? $booking->names }}</div>
                        <div class="booking-time">{{ date('jS F, Y \a\t h:i A', strtotime($booking->created_at ?? now())) }}</div>
                    </div>
                    <div class="status-badge">Awaiting Approval</div>
                </div>

                <div class="booking-details">
                    <div class="detail-item">
                        <div class="detail-label">📧 Email Address</div>
                        <div class="detail-value">{{ $booking->email }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">📱 Phone Number</div>
                        <div class="detail-value">{{ $booking->phone_number }}</div>
                    </div>
                    @if($booking->delivery_date ?? false)
                    <div class="detail-item">
                        <div class="detail-label">📅 Booking Date</div>
                        <div class="detail-value">{{ date('jS F, Y', strtotime($booking->delivery_date)) }}</div>
                    </div>
                    @endif
                    @if($booking->number_of_days ?? false)
                    <div class="detail-item">
                        <div class="detail-label">📆 Duration</div>
                        <div class="detail-value">{{ $booking->number_of_days }} {{ $booking->number_of_days > 1 ? 'Days' : 'Day' }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Section -->
            <div class="action-section">
                <p><strong>Review this booking and take action:</strong></p>
                <a href="{{ $link }}" class="action-button">📋 View Full Booking Details</a>
            </div>

            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-box">
                    <div class="info-box-title">⏰ Booking Status</div>
                    <div class="info-box-value">Pending</div>
                </div>
                <div class="info-box">
                    <div class="info-box-title">📊 Priority</div>
                    <div class="info-box-value">High</div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Customer Notes Section -->
            @if($booking->message ?? false)
            <div style="background-color: #fffbf0; padding: 15px; border-radius: 6px; border-left: 4px solid #ff9800; margin-bottom: 25px;">
                <div style="font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">📝 Customer Notes</div>
                <div style="font-size: 14px; color: #333; line-height: 1.6;">{{ $booking->message }}</div>
            </div>
            @endif

            <!-- Quick Reference -->
            <div style="background-color: #f0f8ff; padding: 15px; border-radius: 6px; border-left: 4px solid #2196F3;">
                <div style="font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">📌 Next Steps</div>
                <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #333; line-height: 1.8;">
                    <li>Review booking details carefully</li>
                    <li>Verify availability and pricing</li>
                    <li>Contact customer if needed</li>
                    <li>Approve or adjust booking terms</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-section">
            <div class="footer-title">📋 Booking Reference</div>
            <div style="font-family: monospace; background-color: #fff; padding: 10px; border-radius: 4px; color: #666; margin: 10px 0; word-break: break-all;">
                ID: #{{ $booking->id }}
            </div>

            <div class="divider" style="margin: 15px 0;"></div>

            <p style="margin: 10px 0; line-height: 1.6;">
                This is an automated notification from Ubuvivi Tours booking system. Please respond to this booking promptly to maintain excellent customer service.
            </p>

            <p style="margin-top: 15px; font-size: 11px; color: #999;">
                © 2026 Ubuvivi Tours & Logistics. Admin notifications are confidential.
            </p>
        </div>
    </div>
</body>
</html>
