@extends('layouts.guest')

@section('title')
    Terms & Conditions - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Terms & Conditions for Ubuvivi Tours & Safaris. Please read our terms before booking.">
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
            <h1>Terms & Conditions</h1>
            <p>Please read these terms carefully before using our services.</p>
        </div>
    </section>

    {{-- Policy Content --}}
    <section class="policy-section">
        <div class="container">
            <div class="policy-container">
                <div class="policy-updated">Last Updated: June 2026</div>

                <h2>1. Acceptance of Terms</h2>
                <p>By accessing and using the Ubuvivi Tours & Safaris website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>

                <h2>2. Booking and Reservations</h2>
                <p>All tour bookings and travel reservations made through our website are subject to:</p>
                <ul>
                    <li>Availability of the requested dates and services</li>
                    <li>Verification and confirmation by our team</li>
                    <li>Payment of the full booking amount or deposit as specified</li>
                    <li>Compliance with travel documentation requirements (passports, visas, etc.)</li>
                </ul>

                <h2>3. Payment Terms</h2>
                <ul>
                    <li>Payment must be made in full or as a deposit before the tour commences</li>
                    <li>We accept major credit cards and other payment methods specified on our website</li>
                    <li>All prices are subject to change without notice until a booking is confirmed</li>
                    <li>Taxes and service charges may be added to the final bill</li>
                </ul>

                <h2>4. Cancellation and Refund Policy</h2>
                <ul>
                    <li><strong>30+ Days Before Tour:</strong> Full refund minus 10% administrative fee</li>
                    <li><strong>15-29 Days Before Tour:</strong> 50% refund of total amount paid</li>
                    <li><strong>14 Days or Less Before Tour:</strong> No refund</li>
                    <li>Refunds will be processed within 14-21 business days</li>
                    <li>No refunds for unused portions of a tour or no-shows</li>
                </ul>

                <h2>5. Guest Responsibilities</h2>
                <p>Guests are responsible for:</p>
                <ul>
                    <li>Ensuring they have valid travel documents (passport, visa, etc.)</li>
                    <li>Obtaining travel insurance</li>
                    <li>Complying with local laws and regulations</li>
                    <li>Arriving on time for tour departures</li>
                    <li>Following safety instructions provided by our guides</li>
                    <li>Respecting cultural sites and local communities</li>
                </ul>

                <h2>6. Health and Safety Disclaimer</h2>
                <p>Some tours involve physical activities and exposure to natural elements. Guests acknowledge:</p>
                <ul>
                    <li>They are in good physical condition for the activities</li>
                    <li>They have disclosed any medical conditions to us</li>
                    <li>They understand the risks associated with the tour</li>
                    <li>They participate at their own risk</li>
                </ul>

                <h2>7. Travel Insurance</h2>
                <p>We strongly recommend purchasing comprehensive travel insurance that covers trip cancellations, medical emergencies, and evacuation. Travel insurance is not included in our tour packages.</p>

                <h2>8. Weather and Force Majeure</h2>
                <p>Ubuvivi Tours & Safaris reserves the right to modify or cancel tours due to:</p>
                <ul>
                    <li>Adverse weather conditions</li>
                    <li>Natural disasters</li>
                    <li>Political unrest or security concerns</li>
                    <li>Pandemics or health emergencies</li>
                    <li>Other circumstances beyond our control</li>
                </ul>
                <p>In such cases, guests will be offered an alternative date or full refund.</p>

                <h2>9. Liability Limitation</h2>
                <p>Ubuvivi Tours & Safaris is not responsible for:</p>
                <ul>
                    <li>Injuries, accidents, or death during tours</li>
                    <li>Loss, theft, or damage to personal belongings</li>
                    <li>Delays or modifications to itineraries due to circumstances beyond our control</li>
                    <li>Services provided by third-party vendors (hotels, airlines, etc.)</li>
                </ul>
                <p>We provide tours as-is. Guests participate entirely at their own risk.</p>

                <h2>10. Age and Capacity Requirements</h2>
                <ul>
                    <li>Guests must be at least 18 years old to make independent bookings</li>
                    <li>Children must be accompanied by an adult</li>
                    <li>Special requirements (e.g., wheelchair accessibility) must be communicated in advance</li>
                </ul>

                <h2>11. Intellectual Property</h2>
                <p>All content on our website (images, text, videos, logos) is the property of Ubuvivi Tours & Safaris. Unauthorized use, reproduction, or distribution is prohibited.</p>

                <h2>12. Website Use Restrictions</h2>
                <p>You agree not to:</p>
                <ul>
                    <li>Use our website for any illegal purpose</li>
                    <li>Engage in hacking, scraping, or unauthorized data collection</li>
                    <li>Post offensive, defamatory, or harassing content</li>
                    <li>Attempt to disrupt or interfere with website functionality</li>
                    <li>Violate any applicable laws or regulations</li>
                </ul>

                <h2>13. Third-Party Links</h2>
                <p>Our website may contain links to third-party websites. We are not responsible for the content, accuracy, or practices of external sites. Your use of third-party sites is at your own risk.</p>

                <h2>14. Indemnification</h2>
                <p>You agree to indemnify and hold harmless Ubuvivi Tours & Safaris, its owners, employees, and agents from any claims, damages, or losses arising from your use of our services or violation of these terms.</p>

                <h2>15. Modification of Terms</h2>
                <p>We reserve the right to modify these terms at any time. Changes will be effective upon posting to our website. Your continued use of our services constitutes acceptance of modified terms.</p>

                <h2>16. Severability</h2>
                <p>If any provision of these terms is deemed invalid or unenforceable, the remaining provisions shall continue in full force and effect.</p>

                <h2>17. Contact Information</h2>
                <p>For questions about these terms, please contact us:</p>
                <ul>
                    <li><strong>Email:</strong> <a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a></li>
                    <li><strong>Phone:</strong> +250 789 044 222</li>
                    <li><strong>Address:</strong> Remera - Kisimenti KG11 Ave, Amahoro Stadium Road, Ikaze House, 3rd Floor, Kigali, Rwanda</li>
                </ul>

                <h2>18. Governing Law</h2>
                <p>These terms and conditions are governed by and construed in accordance with the laws of Rwanda, and you irrevocably submit to the exclusive jurisdiction of the courts of Rwanda.</p>
            </div>
        </div>
    </section>

@endsection
