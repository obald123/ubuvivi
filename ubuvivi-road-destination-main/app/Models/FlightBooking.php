<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightBooking extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'names', 'email', 'phone_number', 'airline',
        'departure_airport', 'arrival_airport',
        'trip_type', 'flight_class', 'number_of_passengers',
        'departure_date', 'return_date',
        'passport_photos', 'additional_info', 'approved', 'access_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->access_token) {
                $model->access_token = self::generateUniqueToken();
            }
        });
    }

    public static function generateUniqueToken()
    {
        do {
            $token = \Illuminate\Support\Str::random(32);
        } while (self::where('access_token', $token)->exists());

        return $token;
    }

    public static function findByToken($token)
    {
        return self::where('access_token', $token)->first();
    }

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
