<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Payment
 * @package App\Models
 * @version February 2, 2022, 2:22 pm UTC
 *
 * @property \App\Models\Booking $booking
 * @property integer $amount
 * @property integer $booking_id
 */
class Payment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'payments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'tour_booking_id',
        'car_booking_id',
        'car_transfer_id',
        'transaction_ref',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'tour_booking_id' => 'integer',
        'car_booking_id'  => 'integer',
        'car_transfer_id' => 'integer',
        'transaction_ref' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'transaction_ref' => 'required|string',
        'status' => 'required|string',
        'tour_booking_id' => 'nullable',
        'car_booking_id' => 'nullable',
        'car_transfer_id' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tourBooking()
    {
        return $this->belongsTo(\App\Models\TourBooking::class, "tour_booking_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function carBooking()
    {
        return $this->belongsTo(\App\Models\CarBooking::class, "car_booking_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function carTransfer()
    {
        return $this->belongsTo(\App\Models\CarTransfer::class, "car_transfer_id");
    }
}
