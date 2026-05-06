<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transfer
 * @package App\Models
 * @version May 5, 2026, 10:59 am UTC
 *
 * @property string $pickup_location
 * @property string $destination
 * @property string $pickup_date
 * @property string $pickup_time
 * @property integer $number_of_days
 * @property string $message
 * @property float $price
 * @property boolean $approved
 * @property string $transfer_type
 */
class Transfer extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'transfers';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'pickup_location',
        'destination',
        'pickup_date',
        'pickup_time',
        'number_of_days',
        'message',
        'price',
        'approved',
        'transfer_type',
        'vehicle_id',
        'driver_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pickup_location' => 'string',
        'destination' => 'string',
        'pickup_date' => 'date',
        'pickup_time' => 'string',
        'number_of_days' => 'integer',
        'message' => 'string',
        'price' => 'float',
        'approved' => 'boolean',
        'transfer_type' => 'string',
        'vehicle_id' => 'integer',
        'driver_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pickup_location' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'pickup_date' => 'required|date',
        'pickup_time' => 'required|string',
        'number_of_days' => 'nullable|integer|min:1',
        'message' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'approved' => 'nullable|boolean',
        'transfer_type' => 'required|in:airport,hotel,private',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(\App\Models\Vehicle::class, 'vehicle_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(\App\Models\User::class, 'driver_id');
    }
}
