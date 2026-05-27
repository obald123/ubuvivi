<?php

namespace App\Models;

use Eloquent as Model;
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
    use HasFactory;

    public $table = 'car_bookings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'names',
        'email',
        'phone_number',
        'delivery_location',
        'delivery_date',
        'delivery_time',
        'return_date',
        'return_time',
        'booking_type',
        'destination',
        'number_of_days',
        'message',
        'price',
        'approved',
        'access_token'
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
        'return_date' => 'string',
        'return_time' => 'string',
        'booking_type' => 'string',
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
        'delivery_location' => 'required|string|max:255',
        'delivery_date' => 'required|string|max:255',
        'delivery_time' => 'required|string|max:255',
        'number_of_days' => 'required|string|max:255',
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
        return $this->belongsToMany(\App\Models\Vehicle::class, 'vehicle_bookings', "car_booking_id", "vehicle_id");
    }
}
