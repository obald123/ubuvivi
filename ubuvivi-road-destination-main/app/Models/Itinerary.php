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

    // Accessors to ensure proper JSON decoding
    public function getImagesAttribute($value)
    {
        return $this->decodeArrayAttribute($value);
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = $this->encodeArrayAttribute($value);
    }

    public function getImageIdAttribute($value)
    {
        return $this->decodeArrayAttribute($value);
    }

    public function setImageIdAttribute($value)
    {
        $this->attributes['image_id'] = $this->encodeArrayAttribute($value);
    }

    public function getHighlightsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function getInclusionsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function getExclusionsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function getDaysDescriptionAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    private function decodeArrayAttribute($value): array
    {
        while (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return [];
            }
            $value = $decoded;
        }

        return is_array($value) ? $value : [];
    }

    private function encodeArrayAttribute($value): string
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            }
        }

        return json_encode(is_array($value) ? array_values($value) : []);
    }
}
