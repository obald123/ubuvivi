<?php

namespace App\Repositories;

use App\Models\TourBooking;
use App\Repositories\BaseRepository;

/**
 * Class TourBookingRepository
 * @package App\Repositories
 * @version February 28, 2022, 3:41 pm UTC
*/

class TourBookingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'itinerary_id',
        'names',
        'email',
        'phone_number',
        'date',
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
        return TourBooking::class;
    }
}
