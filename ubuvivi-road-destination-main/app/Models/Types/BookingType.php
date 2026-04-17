<?php

namespace App\Models\Types;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BookingType
 * @package App\Models\Types
 * @version February 2, 2022, 2:21 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $bookings
 * @property \Illuminate\Database\Eloquent\Collection $packages
 * @property string $name
 */
class BookingType extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'booking_types';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function bookings()
    {
        return $this->hasMany(\App\Models\Types\Booking::class, 'booking_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function packages()
    {
        return $this->hasMany(\App\Models\Types\Package::class, 'booking_type_id');
    }
}
