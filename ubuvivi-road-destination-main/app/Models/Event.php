<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Event
 * @package App\Models
 * @version May 5, 2026, 10:59 am UTC
 *
 * @property string $title
 * @property string $description
 * @property float $price
 * @property string $event_type
 * @property string $location
 * @property string $start_date
 * @property string $end_date
 * @property integer $capacity
 * @property boolean $approved
 */
class Event extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'events';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'description',
        'price',
        'event_type',
        'location',
        'start_date',
        'end_date',
        'capacity',
        'approved'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'price' => 'float',
        'event_type' => 'string',
        'location' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'capacity' => 'integer',
        'approved' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'event_type' => 'required|in:corporate,wedding,party,conference,other',
        'location' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'capacity' => 'nullable|integer|min:1',
        'approved' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
}
