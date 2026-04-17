<?php

namespace App\Models\Types;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class FuelType
 * @package App\Models\Types
 * @version February 2, 2022, 2:21 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $vehicles
 * @property string $name
 */
class FuelType extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'fuel_types';
    
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
    public function vehicles()
    {
        return $this->hasMany(\App\Models\Types\Vehicle::class, 'fuel_type_id');
    }
}
