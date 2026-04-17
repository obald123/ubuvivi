<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Booking
 * @package App\Models
 * @version February 2, 2022, 2:22 pm UTC
 *
 * @property \App\Models\BookingType $bookingType
 * @property \App\Models\Package $package
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @property \Illuminate\Database\Eloquent\Collection $vehicles
 * @property \Illuminate\Database\Eloquent\Collection $payments
 * @property integer $booking_type_id
 * @property integer $package_id
 * @property string $price
 * @property string $departure_address
 * @property string $arrival_address
 * @property string $departure_time
 * @property string $arrival_time
 * @property boolean $approved
 */
class Booking extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'vehicle_bookings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'car_booking_id',
        'vehicle_id',
        'car_transfer_id',
    ];
}
