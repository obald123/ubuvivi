@extends('layouts.guest')

@section('title')
    Privacy Policy - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Privacy Policy for Ubuvivi Tours & Safaris. Learn how we protect your personal information.">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    .policy-hero {
        position: relative;
        height: 380px;
        background: url('{{ asset("assets/images/backgrounds/bg_03.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .policy-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.70);
    }
    .policy-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .policy-hero-content h1 {
        font-size: clamp(30px, 5vw, 56px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        margin-bottom: 12px;
    }
    .policy-hero-content p {
        font-size: 17px;
        color: rgba(255,255,255,.82);
        max-width: 500px;
        margin: 0 auto;
    }

    .policy-section {
        background: #f7f8fb;
        padding: 80px 0 100px;
    }
    .policy-container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        padding: 60px 50px;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,31,53,.08);
    }
    .policy-container h2 {
        font-size: 24px;
        font-weight: 800;
        color: #1a1a1a;
        margin-top: 32px;
        margin-bottom: 16px;
        line-height: 1.35;
    }
    .policy-container h2:first-child {
        margin-top: 0;
    }
    .policy-container h3 {
        font-size: 18px;
        font-weight: 700;
        color: #2a3a4a;
        margin-top: 24px;
        margin-bottom: 12px;
    }
    .policy-container p {
        font-size: 15px;
        color: #555;
        line-height: 1.8;
        margin-bottom: 14px;
    }
    .policy-container ul, .policy-container ol {
        font-size: 15px;
        color: #555;
        line-height: 1.8;
        margin-bottom: 14px;
        margin-left: 20px;
    }
    .policy-container li {
        margin-bottom: 8px;
    }
    .policy-container strong {
        color: #1a1a1a;
        font-weight: 600;
    }
    .policy-updated {
        font-size: 13px;
        color: #999;
        font-style: italic;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    @media (max-width: 768px) {
        .policy-container {
            padding: 40px 28px;
        }
    }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="policy-hero">
        <div class="policy-hero-content">
            <h1>Privacy Policy</h1>
            <p>Your privacy is important to us.</p>
        </div>
    </section>

    {{-- Policy Content --}}
    <section class="policy-section">
        <div class="container">
            <div class="policy-container">
                <div class="policy-updated">Last Updated: June 2026</div>

                <h2>Introduction</h2>
                <p>At Ubuvivi Tours & Safaris ("we", "our", or "us"), we are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p>

                <h2>Information We Collect</h2>
                <p>We may collect information about you in a variety of ways. The information we may collect on the site includes:</p>
                <ul>
                    <li><strong>Personal Data:</strong> Name, email address, phone number, mailing address, and payment information when you make a booking.</li>
                    <li><strong>Browsing Data:</strong> Information about your interactions with our website, including pages visited, time spent, and links clicked.</li>
                    <li><strong>Device Information:</strong> Device type, operating system, browser type, and IP address.</li>
                    <li><strong>Cookies:</strong> We use cookies to enhance your browsing experience and collect analytics data.</li>
                </ul>

                <h2>How We Use Your Information</h2>
                <p>We use the information we collect for various purposes:</p>
                <ul>
                    <li>Process and fulfill your tour bookings and reservations</li>
                    <li>Send booking confirmations and travel information</li>
                    <li>Respond to your inquiries and customer service requests</li>
                    <li>Send promotional emails, newsletters, and marketing materials (with your consent)</li>
                    <li>Improve our website and services</li>
                    <li>Comply with legal obligations</li>
                    <li>Prevent fraudulent activity and unauthorized access</li>
                </ul>

                <h2>Information Sharing</h2>
                <p>We do not sell, trade, or rent your personal information to third parties. However, we may share your information with:</p>
                <ul>
                    <li><strong>Service Providers:</strong> Third-party vendors who assist us in operating our website and conducting our business (e.g., payment processors, email providers)</li>
                    <li><strong>Legal Requirements:</strong> When required by law or to protect our legal rights</li>
                    <li><strong>Business Partners:</strong> Hotels, airlines, and other travel partners necessary to fulfill your bookings</li>
                </ul>

                <h2>Data Security</h2>
                <p>We implement industry-standard security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet is 100% secure.</p>

                <h2>Your Privacy Rights</h2>
                <p>Depending on your location, you may have certain rights regarding your personal information:</p>
                <ul>
                    <li>Right to access your personal data</li>
                    <li>Right to correct inaccurate information</li>
                    <li>Right to request deletion of your information</li>
                    <li>Right to withdraw consent for email marketing</li>
                    <li>Right to data portability</li>
                </ul>

                <h2>Cookies and Tracking Technologies</h2>
                <p>Our website uses cookies to enhance your experience. You can control cookie settings through your browser preferences. Disabling cookies may affect the functionality of certain website features.</p>

                <h2>Third-Party Links</h2>
                <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of external sites. We encourage you to review their privacy policies before providing any personal information.</p>

                <h2>Contact Us</h2>
                <p>If you have any questions about this Privacy Policy or our privacy practices, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a></li>
                    <li><strong>Phone:</strong> +250 789 044 222</li>
                    <li><strong>Address:</strong> Remera - Kisimenti KG11 Ave, Amahoro Stadium Road, Ikaze House, 3rd Floor, Kigali, Rwanda</li>
                </ul>

                <h2>Policy Changes</h2>
                <p>We may update this Privacy Policy from time to time. We will notify you of any changes by updating the "Last Updated" date above. Your continued use of our website following the posting of revised Privacy Policy means that you accept and agree to the changes.</p>
            </div>
        </div>
    </section>

@endsection
