<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TourBooking
 * @package App\Models
 * @version February 28, 2022, 3:41 pm UTC
 *
 * @property \App\Models\Itinerary $itinerary
 * @property integer $itinerary_id
 * @property string $names
 * @property string $email
 * @property string $phone_number
 * @property string $date
 * @property string $message
 * @property string $price
 * @property boolean $approved
 */
class TourBooking extends Model
{
    use HasFactory;

    public $table = 'tour_bookings';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'itinerary_id',
        'names',
        'email',
        'phone_number',
        'number_of_people',
        'date',
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
        'itinerary_id' => 'integer',
        'names' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'number_of_people' => 'string',
        'date' => 'string',
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
        'itinerary_id' => 'nullable',
        'names' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'date' => 'required|string|max:255',
        'message' => 'required|string',
        'price' => 'required|string|max:255',
        'approved' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itinerary()
    {
        return $this->belongsTo(\App\Models\Itinerary::class, 'itinerary_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tour()
    {
        return $this->belongsTo(\App\Models\Itinerary::class, 'itinerary_id');
    }
}
