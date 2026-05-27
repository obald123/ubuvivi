<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use phpDocumentor\Reflection\Types\This;

/**
 * Class Vehicle
 * @package App\Models
 * @version February 2, 2022, 2:24 pm UTC
 *
 * @property \App\Models\VehicleBrand $brand
 * @property \App\Models\FuelType $fuelType
 * @property \App\Models\VehicleModel $model
 * @property \App\Models\Transmission $transmission
 * @property \Illuminate\Database\Eloquent\Collection $bookings
 * @property integer $brand_id
 * @property integer $model_id
 * @property string $production_year
 * @property string $plate_number
 * @property integer $seats
 * @property integer $price
 * @property string $currency
 * @property integer $transmission_id
 * @property integer $fuel_type_id
 * @property integer $one_day_caution
 * @property integer $other_caution
 * @property string $location
 * @property array $images
 * @property string $properties
 * @property boolean $approved
 * @property boolean $for_sale
 * @property boolean $on_lease
 * @property boolean $sold
 * @property string $description
 */
class Vehicle extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'vehicles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'brand_id',
        'model_id',
        'production_year',
        'plate_number',
        'seats',
        'price',
        'currency',
        'transmission_id',
        'fuel_type_id',
        'one_day_caution',
        'other_caution',
        'location',
        'images',
        'image_id',
        'properties',
        'approved',
        'for_sale',
        'on_lease',
        'sold',
        "description"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'brand_id' => 'integer',
        'model_id' => 'integer',
        'production_year' => 'string',
        'plate_number' => 'string',
        'seats' => 'integer',
        'price' => 'integer',
        'currency' => 'string',
        'transmission_id' => 'integer',
        'fuel_type_id' => 'integer',
        'one_day_caution' => 'integer',
        'other_caution' => 'integer',
        'location' => 'string',
        'images' => 'array',
        'image_id' => 'array',
        'properties' => 'string',
        'approved' => 'boolean',
        'for_sale' => 'boolean',
        'on_lease' => 'boolean',
        'sold' => 'boolean',
        'description' => 'string'
    ];

    public function getImagesAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return is_array($value) ? $value : [];
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'brand_id' => 'nullable',
        'model_id' => 'nullable',
        'production_year' => 'nullable|string|max:255',
        'plate_number' => 'nullable|string|max:255',
        'seats' => 'nullable|integer',
        'price' => 'nullable|integer',
        'currency' => 'nullable|string|max:255',
        'transmission_id' => 'nullable',
        'fuel_type_id' => 'nullable',
        'one_day_caution' => 'required|integer',
        'other_caution' => 'nullable|integer',
        'location' => 'nullable|string|max:255',
        'images' => 'nullable',
        'properties' => 'nullable|string',
        'approved' => 'nullable|boolean',
        'for_sale' => 'nullable|boolean',
        'on_lease' => 'nullable|boolean',
        'description' => 'nullable|string',
        'sold' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function is_json($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function brand()
    {
        return $this->belongsTo(\App\Models\Types\VehicleBrand::class, 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fuelType()
    {
        return $this->belongsTo(\App\Models\Types\FuelType::class, 'fuel_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function model()
    {
        return $this->belongsTo(\App\Models\Types\VehicleModel::class, 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function transmission()
    {
        return $this->belongsTo(\App\Models\Types\Transmission::class, 'transmission_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function bookings()
    {
        return $this->belongsToMany(\App\Models\CarBooking::class, 'vehicle_bookings', "vehicle_id", "car_booking_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function transfers()
    {
        return $this->belongsToMany(CarTransfer::class, 'vehicle_bookings',  "vehicle_id", "car_transfer_id");
    }
}
