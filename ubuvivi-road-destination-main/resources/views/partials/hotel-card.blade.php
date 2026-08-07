@php
    $hImages   = $hotel->images ?? [];
    $detailUrl = route('hotel.view', $hotel->id);
@endphp
<div class="hotel-card">
    @if($hotel->cover_image)
        <a href="{{ $detailUrl }}" class="hotel-card-img clickable" style="background-image:url('{{ htmlspecialchars($hotel->cover_image, ENT_QUOTES, 'UTF-8') }}');background-size:cover;background-position:center;display:block;">
            @if(count($hImages) > 1)
                <span class="hotel-photos-badge"><i class="fas fa-images"></i> {{ count($hImages) }} photos</span>
            @endif
        </a>
    @else
        <a href="{{ $detailUrl }}" class="hotel-card-img" style="background:#e4e8f0;display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-hotel" style="font-size:40px;color:#bbb;"></i>
        </a>
    @endif
    <div class="hotel-card-body">
        <div class="hotel-stars">
            @for($i = 0; $i < $hotel->stars; $i++)<i class="fas fa-star"></i>@endfor
            @for($i = $hotel->stars; $i < 5; $i++)<i class="far fa-star" style="color:#ddd;"></i>@endfor
        </div>
        <a href="{{ $detailUrl }}" class="hotel-name" style="color:inherit;text-decoration:none;display:block;">{{ $hotel->name }}</a>
        <div class="hotel-location">
            <i class="fas fa-map-marker-alt"></i> {{ $hotel->location }}
        </div>
        <div class="hotel-features">
            @foreach(array_slice($hotel->amenities ?? [], 0, 4) as $am)
                <span class="hotel-feature-tag">{{ $am }}</span>
            @endforeach
        </div>
        <div class="hotel-footer">
            <div>
                @if($hotel->price_per_night)
                    <div class="hotel-price-label">Starting from</div>
                    <span class="hotel-price">${{ number_format($hotel->price_per_night, 0) }}</span>
                    <span class="hotel-price-night">/night</span>
                @else
                    <span class="hotel-price" style="font-size:16px;color:#888;">Contact for price</span>
                @endif
            </div>
            <a href="{{ $detailUrl }}" class="hotel-book-btn" style="text-decoration:none;display:inline-block;">
                View Details
            </a>
        </div>
    </div>
</div>
