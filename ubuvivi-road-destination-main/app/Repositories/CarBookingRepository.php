<?php

namespace App\Repositories;

use App\Models\CarBooking;
use App\Repositories\BaseRepository;

/**
 * Class CarBookingRepository
 * @package App\Repositories
 * @version February 22, 2022, 4:06 pm UTC
*/

class CarBookingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'names',
        'email',
        'phone_number',
        'delivery_location',
        'delivery_date',
        'delivery_time',
        'number_of_days',
        'message',
        'price',
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
        return CarBooking::class;
    }
}
