<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightBooking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'names', 'email', 'phone_number', 'airline',
        'departure_airport', 'arrival_airport',
        'trip_type', 'flight_class', 'number_of_passengers',
        'departure_date', 'return_date',
        'passport_photos', 'additional_info', 'approved',
    ];

    protected $casts = [
        'passport_photos' => 'array',
        'departure_date'  => 'date',
        'return_date'     => 'date',
        'approved'        => 'boolean',
    ];

    public function getFlightClassLabelAttribute(): string
    {
        return match($this->flight_class) {
            'business'  => 'Business Class',
            'first'     => 'First Class',
            'premium'   => 'Premium Economy',
            default     => 'Economy',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        if ($this->approved === true)  return 'Approved';
        if ($this->approved === false) return 'Rejected';
        return 'Pending';
    }
}
