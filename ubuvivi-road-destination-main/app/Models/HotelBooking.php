<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBooking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'hotel_id', 'names', 'email', 'phone_number',
        'check_in', 'check_out', 'number_of_guests',
        'room_type', 'message', 'approved',
    ];

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
