@extends('layouts.guest')

@section('title')
    Conference Planning Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description" content="Professional conference planning services in Rwanda by Ubuvivi. From private meetings to full conference management.">
    <meta name="keywords" content="ubuvivi, conference planning Rwanda, conference management Kigali, corporate events Rwanda">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .events-hero {
        position: relative;
        height: 100vh;
        min-height: 520px;
        background: url('{{ asset("assets/images/backgrounds/bg_01.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .events-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.50);
    }
    .events-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .events-hero-content h1 {
        font-size: clamp(34px, 6vw, 64px);
        font-weight: 800;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        max-width: 760px;
        margin: 0 auto 16px;
        line-height: 1.2;
    }
    .events-hero-content p {
        font-size: 18px;
        color: rgba(255,255,255,.88);
        max-width: 540px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ── Services Section ── */
    .events-services {
        background: #fff;
        padding: 80px 0;
    }
    .events-services .section-title {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 900;
        color: #1a1a1a;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 6px;
    }
    .events-services .title-underline {
        width: 80px;
        height: 3px;
        background: #C85A2A;
        margin: 0 auto 50px;
        border-radius: 2px;
    }

    /* ── Event Cards ── */
    .event-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 20px rgba(0,0,0,.09);
        transition: transform .25s, box-shadow .25s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,.15);
    }
    .event-card-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }
    .event-card-body {
        padding: 20px 22px 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .event-card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 4px;
    }
    .event-card-subtitle {
        font-size: 14px;
        color: #777;
        margin-bottom: 16px;
    }
    .event-card-link {
        color: #C85A2A;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: auto;
        transition: color .2s;
    }
    .event-card-link:hover { color: #a84520; }

    /* ── CTA Banner ── */
    .events-cta {
        background: #0D1F35;
        padding: 60px 0;
        text-align: center;
    }
    .events-cta h2 { color: #fff; font-size: 30px; font-weight: 700; margin-bottom: 12px; }
    .events-cta p { color: rgba(255,255,255,.75); font-size: 16px; margin-bottom: 28px; }
    .events-cta .cta-btn {
        background: #C85A2A;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 14px 36px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: background .2s;
    }
    .events-cta .cta-btn:hover { background: #a84520; color: #fff; text-decoration: none; }

    /* ── Quick Booking Form ── */
    .quick-booking-section {
        background: #f8f9fa;
        padding: 60px 0;
    }
    .quick-booking-form {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 3rem;
        max-width: 800px;
        margin: 0 auto;
    }
    .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 2rem;
        color: var(--navy);
        font-family: 'Playfair Display', serif;
        text-align: center;
    }
    .quick-booking-form .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .quick-booking-form .form-group {
        display: flex;
        flex-direction: column;
    }
    .quick-booking-form .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--navy);
    }
    .quick-booking-form .form-group input,
    .quick-booking-form .form-group textarea {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
        font-family: 'Poppins', sans-serif;
    }
    .quick-booking-form .form-group input:focus,
    .quick-booking-form .form-group textarea:focus {
        outline: none;
        border-color: var(--orange);
    }
    .quick-booking-form .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }
    .submit-request-btn {
        background: var(--orange);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .submit-request-btn:hover {
        background: #a84520;
    }
    .form-note {
        text-align: center;
        color: #666;
        font-size: 0.9rem;
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .form-note i {
        color: var(--orange);
    }

    @media (max-width: 768px) {
        .quick-booking-form {
            padding: 2rem;
            margin: 1rem;
        }
        .quick-booking-form .form-row {
            grid-template-columns: 1fr;
        }
        .form-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="events-hero">
        <div class="events-hero-content">
            <h1>Professional Conference Planning in Rwanda</h1>
            <p>From intimate gatherings to grand celebrations — we plan it all.</p>
        </div>
    </section>

    {{-- ── Events Grid ── --}}
    <section class="events-services">
        <div class="container">
            <h2 class="section-title">Available Events</h2>
            <div class="title-underline"></div>

            @if($events->count())
                <div class="row">
                    @foreach($events as $event)
                    <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="event-card w-100">
                            <img src="{{ asset('assets/images/backgrounds/bg_04.jpg') }}"
                                 alt="{{ $event->title }}" class="event-card-img">
                            <div class="event-card-body">
                                <h3 class="event-card-title">{{ $event->title }}</h3>
                                <p class="event-card-subtitle">{{ $event->event_type }} - {{ $event->location }}</p>
                                @if($event->description)
                                    <p style="font-size: 14px; color: #666; margin: 8px 0; line-height: 1.4;">
                                        {{ Str::limit($event->description, 120) }}
                                    </p>
                                @endif
                                <div style="margin-top: 12px;">
                                    <span style="font-size: 16px; font-weight: 600; color: #C85A2A;">
                                        From ${{ number_format($event->price) }}
                                    </span>
                                    @if($event->start_date && $event->end_date)
                                        <span style="font-size: 14px; color: #777; margin-left: 8px;">
                                            {{ date('M j, Y', strtotime($event->start_date)) }} - {{ date('M j, Y', strtotime($event->end_date)) }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('guest.contact') }}" class="event-card-link">
                                    Book This Event &raquo;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-alt" style="font-size: 40px; color: #C85A2A; display: block; margin-bottom: 16px;"></i>
                    <h3 style="color: #666; margin-bottom: 16px;">No Events Available</h3>
                    <p style="color: #888;">Check back soon for upcoming events!</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ── CTA Banner ── --}}
    <section class="events-cta">
        <div class="container">
            <h2>Ready to Plan Your Conference?</h2>
            <p>Contact us today and let's create something unforgettable together.</p>
            <a href="{{ route('guest.contact') }}" class="cta-btn">Get in Touch</a>
        </div>
    </section>

    {{-- ── Quick Booking Form ── --}}
    <section class="quick-booking-section">
        <div class="container">
            <div class="quick-booking-form">
                <h2 class="form-title">Quick Booking</h2>
                <form id="quickBookingForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <input type="text" id="full-name" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="guests">Number of Guests</label>
                            <input type="number" id="guests" name="number_of_guests" min="1" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="service">Service</label>
                            <input type="text" id="service" name="service" value="Conference Planning" readonly>
                        </div>
                        <div class="form-group">
                            <label for="service-type">Service Type</label>
                            <input type="text" id="service-type" name="service_type" value="Full Planning" readonly>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="event-location">Event Location</label>
                            <input type="text" id="event-location" name="event_location" placeholder="Enter event location" required>
                        </div>
                        <div class="form-group">
                            <label for="event-date">Event Date & Time</label>
                            <input type="datetime-local" id="event-date" name="event_date" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="event-details">Event Details</label>
                            <textarea id="event-details" name="event_details" rows="4" placeholder="Describe your event requirements..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="special-requests">Special Requests</label>
                            <textarea id="special-requests" name="special_requests" rows="3" placeholder="Any special requirements..."></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-request-btn">
                        <i class="fas fa-paper-plane"></i>
                        Submit Request
                    </button>
                </form>
                
                <p class="form-note">
                    <i class="fas fa-info-circle"></i>
                    Our team will contact you shortly to confirm your booking.
                </p>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Quick Booking Form Submission
        $('#quickBookingForm').on('submit', function(e) {
            e.preventDefault();
            
            var formData = {
                full_name: $('#full-name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                number_of_guests: $('#guests').val(),
                service: $('#service').val(),
                service_type: $('#service-type').val(),
                event_location: $('#event-location').val(),
                event_date: $('#event-date').val(),
                event_details: $('#event-details').val(),
                special_requests: $('#special-requests').val(),
                _token: "{{ csrf_token() }}"
            };

            // Basic validation
            if (!formData.full_name || !formData.email || !formData.phone || !formData.event_location) {
                alert('Please fill in all required fields.');
                return;
            }

            // Show loading state
            $('.submit-request-btn').html('<i class="fas fa-spinner fa-spin"></i> Submitting...').prop('disabled', true);

            // Here you would typically make an AJAX call to submit form
            $.ajax({
                url: '{{ route("guest.contact") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert('Your event booking request has been submitted successfully! Our team will contact you shortly.');
                    $('#quickBookingForm')[0].reset();
                    $('.submit-request-btn').html('<i class="fas fa-paper-plane"></i> Submit Request').prop('disabled', false);
                },
                error: function() {
                    alert('There was an error submitting your request. Please try again.');
                    $('.submit-request-btn').html('<i class="fas fa-paper-plane"></i> Submit Request').prop('disabled', false);
                }
            });
        });

        // Set minimum datetime for event date
        var now = new Date();
        var localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
        $('#event-date').attr('min', localDateTime);
    });
</script>
@endsection
