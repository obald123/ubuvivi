<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CarTransfer
 * @package App\Models
 * @version February 22, 2022, 4:06 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $vehicleBookings
 * @property string $names
 * @property string $email
 * @property string $phone_number
 * @property string $pickup_location
 * @property string $pickup_date
 * @property string $pickup_time
 * @property string $number_of_days
 * @property string $message
 * @property string $price
 * @property boolean $approved
 */
class CarTransfer extends Model
{
    use HasFactory;

    public $table = 'car_transfers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    


    public $fillable = [
        'names',
        'email',
        'phone_number',
        'pickup_location',
        'pickup_date',
        'pickup_time',
        'destination',
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
        'pickup_location' => 'string',
        'pickup_date' => 'string',
        'pickup_time' => 'string',
        'destination' => 'string',
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
        'pickup_location' => 'required|string|max:255',
        'pickup_date' => 'required|string|max:255',
        'pickup_time' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'number_of_days' => 'nullable|string|max:255',
        'message' => 'required|string',
        'price' => 'required|string|max:255',
        'approved' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function vehicle()
    {
        return $this->belongsToMany(\App\Models\Vehicle::class, 'vehicle_bookings', "car_transfer_id", "vehicle_id");
    }
}
