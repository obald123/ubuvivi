@extends('layouts.guest')

@section('title')
    Contact Us - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Get in touch with Ubuvivi Tours & Safaris. Find our address, phone numbers, email, and send us a message.">
    <meta name="keywords" content="ubuvivi contact, Ubuvivi Tours contact, Rwanda travel agency contact, Kigali tours contact">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .contact-hero {
        position: relative;
        height: 480px;
        background: url('{{ asset("assets/images/backgrounds/bg_03.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .contact-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.70);
    }
    .contact-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .contact-hero-content h1 {
        font-size: clamp(30px, 5vw, 56px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        margin-bottom: 12px;
    }
    .contact-hero-content p {
        font-size: 17px;
        color: rgba(255,255,255,.82);
        max-width: 500px;
        margin: 0 auto;
    }

    /* ── Info + Form section ── */
    .contact-main-section {
        position: relative;
        background: url('{{ asset("assets/images/backgrounds/bg_9.jpg") }}') center / cover no-repeat;
        padding: 80px 0;
    }
    .contact-main-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.85);
    }
    .contact-main-section .container { position: relative; z-index: 1; }

    /* Info cards */
    .contact-info-card {
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.10);
        border-radius: 16px;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 20px;
    }
    .contact-info-icon {
        width: 48px; height: 48px; min-width: 48px;
        border-radius: 50%;
        background: #C85A2A;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; color: #fff;
    }
    .contact-info-text strong {
        display: block;
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .contact-info-text span, .contact-info-text a {
        color: rgba(255,255,255,.78);
        font-size: 14px;
        line-height: 1.7;
        text-decoration: none;
        display: block;
    }
    .contact-info-text a:hover { color: #C85A2A; }

    /* Social icons */
    .contact-socials { display: flex; gap: 12px; margin-top: 28px; }
    .contact-socials a {
        display: inline-flex; align-items: center; justify-content: center;
        width: 44px; height: 44px;
        border-radius: 50%;
        background: rgba(255,255,255,.12);
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        transition: background .2s;
    }
    .contact-socials a:hover { background: #C85A2A; color: #fff; }

    /* Section label */
    .section-label-white {
        display: inline-flex; align-items: center; gap: 10px;
        color: #C85A2A; font-weight: 600; font-size: 14px;
        margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;
    }
    .section-label-white::before {
        content: ''; display: block;
        width: 36px; height: 2px; background: #C85A2A;
    }

    /* Form */
    .contact-form-wrap h2 {
        font-size: 28px; font-weight: 700; color: #fff; margin-bottom: 28px; line-height: 1.3;
    }
    .contact-form-wrap .form-control {
        background: rgba(255,255,255,.97);
        border: none;
        border-radius: 10px;
        padding: 14px 18px;
        font-size: 14px;
        color: #333;
        margin-bottom: 14px;
    }
    .contact-form-wrap .form-control::placeholder { color: #aaa; }
    .contact-form-wrap .form-control:focus {
        box-shadow: 0 0 0 3px rgba(200,90,42,.35);
        outline: none;
        background: #fff;
    }
    .contact-submit-btn {
        width: 100%;
        background: #C85A2A;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 15px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        letter-spacing: .5px;
    }
    .contact-submit-btn:hover { background: #a84520; }

    /* Map */
    .map-section { line-height: 0; }
    .map-section iframe { width: 100%; height: 440px; border: 0; display: block; }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>Get In Touch</h1>
            <p>We're here to help you plan your perfect Rwanda experience.</p>
        </div>
    </section>

    {{-- ── Contact Info + Form ── --}}
    <section class="contact-main-section">
        <div class="container">
            <div class="row">

                {{-- Left: contact info --}}
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">

                    <span class="section-label-white">Contact Info</span>
                    <h2 style="font-size:30px; font-weight:800; color:#fff; margin-bottom:28px; line-height:1.3;">
                        Need more information?<br>We'd love to hear from you.
                    </h2>

                    <div class="contact-info-card">
                        <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-info-text">
                            <strong>Our Address</strong>
                            <span>Remera - Kisimenti KG11 Ave,<br>Amahoro Stadium Road, Ikaze House, 3rd Floor.</span>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-info-text">
                            <strong>Phone Numbers</strong>
                            <a href="tel:+250789044222">+250 789 044 222</a>
                            <a href="tel:+250783123089">+250 783 123 089</a>
                            <a href="tel:+250787229916">+250 787 229 916</a>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-info-text">
                            <strong>Email Address</strong>
                            <a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a>
                        </div>
                    </div>

                    <div class="contact-socials">
                        <a href="https://www.facebook.com/profile.php?id=100077752760078" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/ubuvivitours/" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#!" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>

                </div>

                {{-- Right: form --}}
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-form-wrap">
                        <span class="section-label-white">Send a Message</span>
                        <h2>We'll get back to you<br>as soon as possible.</h2>
                        @include('flash::message')
                        <form action="{{ url('/contact') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address *" required>
                                </div>
                            </div>
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                            <textarea name="message" class="form-control" rows="6" placeholder="Leave your message..." required></textarea>
                            <button type="submit" class="contact-submit-btn">Send Message</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Map ── --}}
    <section class="map-section">
        <iframe
            title="Ubuvivi Tours Location"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.4866435475124!2d30.108154114298564!3d-1.9589186372811278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca76d9f57f4dd%3A0x82fc7b5b7c073b9f!2sUBUVIVI%20Tours%20and%20Car%20Rental!5e0!3m2!1sen!2srw!4v1649668603950!5m2!1sen!2srw"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

@endsection
