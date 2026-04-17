<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CarBooking
 * @package App\Models
 * @version February 22, 2022, 4:06 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $vehicleBookings
 * @property string $names
 * @property string $email
 * @property string $phone_number
 * @property string $delivery_location
 * @property string $delivery_date
 * @property string $delivery_time
 * @property string $number_of_days
 * @property string $message
 * @property string $price
 * @property boolean $approved
 */
class CarBooking extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'car_bookings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'names',
        'email',
        'phone_number',
        'delivery_location',
        'delivery_date',
        'delivery_time',
        'number_of_days',
        'message',
        'price',
        'approved'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'names' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'delivery_location' => 'string',
        'delivery_date' => 'string',
        'delivery_time' => 'string',
        'number_of_days' => 'string',
        'message' => 'string',
        'price' => 'string',
        'approved' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'names' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'delivery_location' => 'required|string|max:255',
        'delivery_date' => 'required|string|max:255',
        'delivery_time' => 'required|string|max:255',
        'number_of_days' => 'required|string|max:255',
        'message' => 'required|string',
        'price' => 'required|string|max:255',
        'approved' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function vehicle()
    {
        return $this->belongsToMany(\App\Models\Vehicle::class, 'vehicle_bookings', "car_booking_id", "vehicle_id");
    }
}
