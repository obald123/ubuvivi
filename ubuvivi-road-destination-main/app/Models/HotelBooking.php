<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelBooking extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'hotel_id', 'source', 'booking_com_hotel_id', 'booking_com_hotel_name',
        'names', 'email', 'phone_number',
        'check_in', 'check_out', 'number_of_guests',
        'room_type', 'message', 'approved', 'access_token',
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
        'check_in'  => 'date',
        'check_out' => 'date',
        'approved'  => 'boolean',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class)->withTrashed();
    }

    public function getStatusLabelAttribute(): string
    {
        if ($this->approved === true)  return 'Approved';
        if ($this->approved === false) return 'Rejected';
        return 'Pending';
    }
}
