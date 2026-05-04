@extends('layouts.guest')

@section('title')
    Book Your Tour - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Book your dream tour with Ubuvivi Tours & Safaris. Choose from amazing destinations across Rwanda and East Africa.">
@endsection

@section('css')
    <style>
        .tour-booking-hero {
            background: linear-gradient(rgba(13, 31, 53, 0.7), rgba(13, 31, 53, 0.7)), 
                        url('https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80') center/cover;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .tour-booking-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .tour-booking-hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .booking-type-indicator {
            background: var(--orange);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .booking-form-section {
            padding: 4rem 0;
            background: #f8f9fa;
        }

        .booking-form-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 3rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-section {
            margin-bottom: 2.5rem;
        }

        .form-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section-title i {
            color: var(--orange);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--navy);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--orange);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .tour-selection {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .tour-option {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .tour-option:hover {
            border-color: var(--orange);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .tour-option.selected {
            border-color: var(--orange);
            background: rgba(200, 90, 42, 0.05);
        }

        .tour-option-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--navy);
        }

        .tour-option-price {
            color: var(--orange);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .tour-option-duration {
            color: #666;
            font-size: 0.9rem;
        }

        .passenger-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .passenger-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .passenger-title {
            font-weight: 600;
            color: var(--navy);
        }

        .remove-passenger {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .add-passenger-btn {
            background: var(--orange);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 1rem;
        }

        .add-passenger-btn:hover {
            background: #a84520;
        }

        .booking-summary {
            background: var(--navy);
            color: white;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .summary-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--orange);
        }

        .submit-btn {
            background: var(--orange);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 1.5rem;
        }

        .submit-btn:hover {
            background: #a84520;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--navy);
            text-decoration: none;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .back-link:hover {
            color: var(--orange);
        }

        @media (max-width: 768px) {
            .tour-booking-hero h1 {
                font-size: 2rem;
            }
            
            .booking-form-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="tour-booking-hero">
        <div class="container">
            @if(request()->get('type') == 'account')
                <div class="booking-type-indicator">
                    <i class="fas fa-user"></i> Account Booking
                </div>
            @else
                <div class="booking-type-indicator">
                    <i class="fas fa-user-secret"></i> Guest Booking
                </div>
            @endif
            
            <h1>Book Your Dream Tour</h1>
            <p>Choose from our amazing destinations and create unforgettable memories</p>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="booking-form-section">
        <div class="container">
            <a href="{{ route('guest.tours_booking_options') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Booking Options
            </a>

            <div class="booking-form-container">
                <form id="tourBookingForm">
                    <!-- Tour Selection -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-map-marked-alt"></i>
                            Select Your Tour
                        </h3>
                        
                        <div class="tour-selection">
                            <div class="tour-option" onclick="selectTour(this, 'gorilla-tracking')">
                                <div class="tour-option-title">Gorilla Tracking Adventure</div>
                                <div class="tour-option-duration">3 Days / 2 Nights</div>
                                <div class="tour-option-price">$1,500 per person</div>
                            </div>
                            
                            <div class="tour-option" onclick="selectTour(this, 'akagera-safari')">
                                <div class="tour-option-title">Akagera National Park Safari</div>
                                <div class="tour-option-duration">2 Days / 1 Night</div>
                                <div class="tour-option-price">$800 per person</div>
                            </div>
                            
                            <div class="tour-option" onclick="selectTour(this, 'nyungwe-chimpanzee')">
                                <div class="tour-option-title">Nyungwe Chimpanzee Tracking</div>
                                <div class="tour-option-duration">2 Days / 1 Night</div>
                                <div class="tour-option-price">$600 per person</div>
                            </div>
                            
                            <div class="tour-option" onclick="selectTour(this, 'kigali-city-tour')">
                                <div class="tour-option-title">Kigali City Tour</div>
                                <div class="tour-option-duration">1 Day</div>
                                <div class="tour-option-price">$150 per person</div>
                            </div>
                        </div>
                    </div>

                    <!-- Travel Details -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-calendar-alt"></i>
                            Travel Details
                        </h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="travel-date">Travel Date</label>
                                <input type="date" id="travel-date" name="travel-date" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="travelers">Number of Travelers</label>
                                <select id="travelers" name="travelers" required>
                                    <option value="">Select travelers</option>
                                    <option value="1">1 Traveler</option>
                                    <option value="2">2 Travelers</option>
                                    <option value="3">3 Travelers</option>
                                    <option value="4">4 Travelers</option>
                                    <option value="5+">5+ Travelers</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger Information -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-users"></i>
                            Passenger Information
                        </h3>
                        
                        <div id="passengers-container">
                            <div class="passenger-info" data-passenger="1">
                                <div class="passenger-header">
                                    <span class="passenger-title">Passenger 1 (Primary)</span>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="first-name-1">First Name</label>
                                        <input type="text" id="first-name-1" name="first-name-1" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="last-name-1">Last Name</label>
                                        <input type="text" id="last-name-1" name="last-name-1" required>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email-1">Email</label>
                                        <input type="email" id="email-1" name="email-1" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="phone-1">Phone</label>
                                        <input type="tel" id="phone-1" name="phone-1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="add-passenger-btn" onclick="addPassenger()">
                            <i class="fas fa-plus"></i> Add Another Passenger
                        </button>
                    </div>

                    <!-- Special Requirements -->
                    <div class="form-section">
                        <h3 class="form-section-title">
                            <i class="fas fa-comment-alt"></i>
                            Special Requirements
                        </h3>
                        
                        <div class="form-group">
                            <label for="special-requirements">Any special requirements or dietary restrictions?</label>
                            <textarea id="special-requirements" name="special-requirements" placeholder="Please let us know if you have any special needs..."></textarea>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div class="booking-summary">
                        <h4 class="summary-title">Booking Summary</h4>
                        
                        <div class="summary-item">
                            <span>Tour Selected:</span>
                            <span id="summary-tour">Not selected</span>
                        </div>
                        
                        <div class="summary-item">
                            <span>Travel Date:</span>
                            <span id="summary-date">Not selected</span>
                        </div>
                        
                        <div class="summary-item">
                            <span>Number of Travelers:</span>
                            <span id="summary-travelers">0</span>
                        </div>
                        
                        <div class="summary-item">
                            <span>Total Amount:</span>
                            <span id="summary-total">$0</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-check"></i> Complete Booking
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let selectedTour = null;
        let passengerCount = 1;
        const tourPrices = {
            'gorilla-tracking': 1500,
            'akagera-safari': 800,
            'nyungwe-chimpanzee': 600,
            'kigali-city-tour': 150
        };

        function selectTour(element, tourId) {
            // Remove previous selection
            document.querySelectorAll('.tour-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selection to clicked element
            element.classList.add('selected');
            selectedTour = tourId;
            
            updateSummary();
        }

        function addPassenger() {
            passengerCount++;
            const container = document.getElementById('passengers-container');
            
            const passengerDiv = document.createElement('div');
            passengerDiv.className = 'passenger-info';
            passengerDiv.setAttribute('data-passenger', passengerCount);
            
            passengerDiv.innerHTML = `
                <div class="passenger-header">
                    <span class="passenger-title">Passenger ${passengerCount}</span>
                    <button type="button" class="remove-passenger" onclick="removePassenger(${passengerCount})">
                        <i class="fas fa-times"></i> Remove
                    </button>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first-name-${passengerCount}">First Name</label>
                        <input type="text" id="first-name-${passengerCount}" name="first-name-${passengerCount}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last-name-${passengerCount}">Last Name</label>
                        <input type="text" id="last-name-${passengerCount}" name="last-name-${passengerCount}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email-${passengerCount}">Email</label>
                        <input type="email" id="email-${passengerCount}" name="email-${passengerCount}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone-${passengerCount}">Phone</label>
                        <input type="tel" id="phone-${passengerCount}" name="phone-${passengerCount}" required>
                    </div>
                </div>
            `;
            
            container.appendChild(passengerDiv);
        }

        function removePassenger(passengerId) {
            const passengerDiv = document.querySelector(`[data-passenger="${passengerId}"]`);
            if (passengerDiv) {
                passengerDiv.remove();
                updateSummary();
            }
        }

        function updateSummary() {
            // Update tour
            const tourElement = document.querySelector('.tour-option.selected .tour-option-title');
            document.getElementById('summary-tour').textContent = tourElement ? tourElement.textContent : 'Not selected';
            
            // Update date
            const dateElement = document.getElementById('travel-date');
            document.getElementById('summary-date').textContent = dateElement.value ? new Date(dateElement.value).toLocaleDateString() : 'Not selected';
            
            // Update travelers count
            const travelersElement = document.getElementById('travelers');
            const travelerCount = travelersElement.value || '0';
            document.getElementById('summary-travelers').textContent = travelerCount === '5+' ? '5+' : travelerCount;
            
            // Calculate total
            if (selectedTour && travelerCount) {
                const price = tourPrices[selectedTour];
                const count = travelerCount === '5+' ? 5 : parseInt(travelerCount);
                const total = price * count;
                document.getElementById('summary-total').textContent = `$${total.toLocaleString()}`;
            } else {
                document.getElementById('summary-total').textContent = '$0';
            }
        }

        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('travel-date').setAttribute('min', today);
            
            // Add event listeners
            document.getElementById('travel-date').addEventListener('change', updateSummary);
            document.getElementById('travelers').addEventListener('change', updateSummary);
            
            // Form submission
            document.getElementById('tourBookingForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!selectedTour) {
                    alert('Please select a tour');
                    return;
                }
                
                // Here you would typically submit the form via AJAX or regular form submission
                alert('Booking functionality would be implemented here with backend integration.');
            });
        });
    </script>
@endsection
