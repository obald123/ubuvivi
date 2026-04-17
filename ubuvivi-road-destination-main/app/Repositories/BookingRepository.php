<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\BaseRepository;

/**
 * Class BookingRepository
 * @package App\Repositories
 * @version February 2, 2022, 2:22 pm UTC
*/

class BookingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'booking_type_id',
        'package_id',
        'price',
        'departure_address',
        'arrival_address',
        'departure_time',
        'arrival_time',
        'approved'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Booking::class;
    }
}
