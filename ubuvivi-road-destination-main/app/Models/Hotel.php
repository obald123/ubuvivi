<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'location', 'description', 'stars',
        'price_per_night', 'images', 'image_ids', 'amenities', 'available',
    ];

    protected $casts = [
        'images'    => 'array',
        'image_ids' => 'array',
        'amenities' => 'array',
        'available' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(HotelBooking::class);
    }

    public function getCoverImageAttribute(): ?string
    {
        $images = $this->images ?? [];
        return count($images) > 0 ? $images[0] : null;
    }
}
