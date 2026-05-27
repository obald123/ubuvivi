<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Ubuvivi Tours</title>
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
            background-color: #f7f7f7;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .header-logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .header-subtitle {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 300;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        .message {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .info-box {
            background-color: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }
        .info-box-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
            font-size: 15px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }
        .info-label {
            font-weight: 500;
            color: #333;
        }
        .info-value {
            color: #667eea;
            font-weight: 500;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            padding: 14px 40px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            margin: 20px 0;
            text-align: center;
            transition: transform 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .cta-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .divider {
            height: 1px;
            background-color: #e8e8e8;
            margin: 30px 0;
        }
        .footer-section {
            background-color: #f9f9f9;
            padding: 30px;
            border-top: 1px solid #e8e8e8;
            font-size: 13px;
            color: #666;
        }
        .footer-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .footer-contact {
            margin: 15px 0;
            line-height: 1.8;
        }
        .footer-contact-item {
            margin-bottom: 8px;
        }
        .footer-social {
            margin-top: 20px;
        }
        .footer-social a {
            display: inline-block;
            margin-right: 15px;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .confirmation-badge {
            display: inline-block;
            background-color: #4caf50;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        @media (max-width: 600px) {
            .container {
                border-radius: 0;
            }
            .content {
                padding: 20px;
            }
            .header {
                padding: 30px 15px;
            }
            .info-item {
                flex-direction: column;
            }
            .cta-button {
                width: 100%;
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-logo">✈️ UBUVIVI TOURS</div>
            <div class="header-subtitle">Your Journey Starts Here</div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="confirmation-badge">✓ Booking Confirmed</div>

            <div class="greeting">Hello,</div>

            <div class="message">
                Thank you for booking with <strong>Ubuvivi Tours & Logistics!</strong> We're thrilled to help you plan an unforgettable journey. Your booking request has been successfully received and is now being processed by our team.
            </div>

            <div class="info-box">
                <div class="info-box-title">📋 What's Next?</div>
                <div style="font-size: 13px; color: #555; line-height: 1.8;">
                    <p>Our dedicated team will review your booking details and contact you within 24 hours with confirmation and additional information about your tour.</p>
                </div>
            </div>

            <div class="cta-wrapper">
                <a href="{{ $link }}" class="cta-button">View Your Booking Details</a>
            </div>

            <div class="message" style="font-size: 13px; background-color: #fffbf0; padding: 15px; border-radius: 4px; border-left: 3px solid #ff9800;">
                <strong>📌 Important:</strong> You can track and manage your booking anytime by clicking the button above. Keep this email safe for your records.
            </div>

            <div class="divider"></div>

            <!-- Help Section -->
            <div style="background-color: #f5f5f5; padding: 20px; border-radius: 4px; margin: 20px 0;">
                <div style="font-weight: 600; color: #333; margin-bottom: 10px; font-size: 14px;">Need Help?</div>
                <div style="font-size: 13px; color: #666; line-height: 1.8;">
                    <p>If you have any questions about your booking or need to make any changes, please don't hesitate to reach out to our customer support team.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-section">
            <div class="footer-title">Ubuvivi Tours & Logistics</div>

            <div class="footer-contact">
                <div class="footer-contact-item">
                    <strong>📍 Address:</strong> Remera - Kisimenti KG11 Ave, Amahoro Stadium Road, Ikaze House, 3rd Floor, Kigali, Rwanda
                </div>
                <div class="footer-contact-item">
                    <strong>📧 Email:</strong> <a href="mailto:ubuvivitours@gmail.com" style="color: #667eea; text-decoration: none;">ubuvivitours@gmail.com</a>
                </div>
                <div class="footer-contact-item">
                    <strong>🌐 Website:</strong> <a href="https://ubuvivitours.com" style="color: #667eea; text-decoration: none;">ubuvivitours.com</a>
                </div>
            </div>

            <div class="footer-social">
                <a href="https://facebook.com" style="color: #667eea;">Facebook</a>
                <a href="https://twitter.com" style="color: #667eea;">Twitter</a>
                <a href="https://instagram.com" style="color: #667eea;">Instagram</a>
            </div>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e8e8e8; font-size: 11px; color: #999;">
                <p>© 2026 Ubuvivi Tours & Logistics. All rights reserved.</p>
                <p>This is an automated email. Please do not reply to this message. For support, contact our team directly.</p>
            </div>
        </div>
    </div>
</body>
</html>
