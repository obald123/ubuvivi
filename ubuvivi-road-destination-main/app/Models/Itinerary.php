<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Itinerary
 * @package App\Models
 * @version February 24, 2022, 2:24 pm UTC
 *
 * @property string $title
 * @property string $description
 * @property string $images
 * @property string $highlights
 * @property string $days_description
 * @property string $inclusions
 * @property string $exclusions
 */
class Itinerary extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'itinerary';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'days',
        'price',
        'description',
        'images',
        'image_id',
        'highlights',
        'days_description',
        'inclusions',
        'exclusions'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'price' => 'integer',
        'images' => 'array',
        'image_id' => 'array',
        'highlights' => 'array',
        'days_description' => 'array',
        'inclusions' => 'array',
        'exclusions' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'highlights' => 'nullable',
        'days_description' => 'nullable',
        'inclusions' => 'nullable',
        'exclusions' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function is_json($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    public function is_serialized($str)
    {
        return is_string($str) && ($str === 'b:0;' || @unserialize($str) !== false);
    }
}
