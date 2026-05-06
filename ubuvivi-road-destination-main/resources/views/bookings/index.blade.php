@extends('layouts.app')
@section('title')
    Bookings
@endsection
@section('content')
    <section class="section">
        <div class="main-header">
            <h1 class="page-title">Bookings</h1>
            <div class="header-actions">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search bookings..." id="searchInput">
                </div>
            </div>
        </div>
        @include('flash::message')
        <div class="content-card">
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">All Bookings</button>
                <button class="filter-tab" data-filter="pending">Pending</button>
                <button class="filter-tab" data-filter="approved">Approved</button>
                <button class="filter-tab" data-filter="completed">Completed</button>
            </div>
            
            <div class="bookings-grid" id="bookingsContainer">
                @foreach ($bookings as $booking)
                    <div class="booking-card" data-status="{{ $booking->approved ? 'approved' : 'pending' }}">
                        <div class="booking-header">
                            <div class="booking-info">
                                <h3 class="booking-title">Booking #{{ $booking->id }}</h3>
                                <span class="booking-type">{{ $booking->booking_type_id }}</span>
                            </div>
                            <div class="booking-price">$ {{ number_format($booking->price, 2) }}</div>
                        </div>
                        <div class="booking-details">
                            <div class="detail-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>From:</strong> {{ $booking->departure_address ?: 'N/A' }}
                                </div>
                            </div>
                            <div class="detail-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>To:</strong> {{ $booking->arrival_address ?: 'N/A' }}
                                </div>
                            </div>
                            <div class="detail-row">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <strong>Date:</strong> {{ $booking->departure_time ? date('M j, Y', strtotime($booking->departure_time)) : 'N/A' }}
                                </div>
                            </div>
                            <div class="detail-row">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <strong>Time:</strong> {{ $booking->arrival_time ?: 'N/A' }}
                                </div>
                            </div>
                        </div>
                        <div class="booking-footer">
                            <span class="status-badge {{ $booking->approved ? 'approved' : 'pending' }}">
                                {{ $booking->approved ? 'Approved' : 'Pending' }}
                            </span>
                            <div class="booking-actions">
                                <a href="{!! route('bookings.show', [$booking->booking_type_id, $booking->id]) !!}" class="btn-action btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{!! route('bookings.edit', [$booking->booking_type_id, $booking->id]) !!}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{!! route('bookings.destroy', $booking->id) !!}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirm('Are you sure want to delete this record?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if ($bookings->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>No Bookings Found</h3>
                    <p>There are no bookings available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('css')
<style>
.bookings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.booking-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.booking-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.booking-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.booking-info {
    flex: 1;
}

.booking-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #0D1F35;
    margin: 0 0 0.5rem 0;
}

.booking-type {
    display: inline-block;
    background: #C85A2A;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.booking-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #C85A2A;
}

.booking-details {
    padding: 1.5rem;
}

.detail-row {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.detail-row i {
    color: #C85A2A;
    width: 18px;
    text-align: center;
}

.detail-row div {
    flex: 1;
    font-size: 0.9rem;
    color: #666;
    line-height: 1.4;
}

.detail-row strong {
    color: #0D1F35;
    font-weight: 600;
}

.booking-footer {
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.booking-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
}

.btn-view {
    background: #e3f2fd;
    color: #1976d2;
}

.btn-view:hover {
    background: #bbdefb;
    color: #1565c0;
}

.btn-edit {
    background: #fff3e0;
    color: #f57c00;
}

.btn-edit:hover {
    background: #ffe0b2;
    color: #ef6c00;
}

.btn-delete {
    background: #ffebee;
    color: #d32f2f;
}

.btn-delete:hover {
    background: #ffcdd2;
    color: #c62828;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #666;
}

.empty-state i {
    font-size: 3rem;
    color: #C85A2A;
    margin-bottom: 1rem;
    display: block;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #0D1F35;
}

@media (max-width: 768px) {
    .bookings-grid {
        grid-template-columns: 1fr;
    }
    
    .booking-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .booking-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .booking-actions {
        justify-content: center;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterTabs = document.querySelectorAll('.filter-tab');
    const bookingCards = document.querySelectorAll('.booking-card');
    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            bookingCards.forEach(card => {
                const status = card.dataset.status;
                if (filter === 'all' || status === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            bookingCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? 'block' : 'none';
            });
        });
    }
});
</script>
@endpush
