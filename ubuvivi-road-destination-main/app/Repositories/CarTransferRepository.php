<?php

namespace App\Repositories;

use App\Models\CarTransfer;
use App\Repositories\BaseRepository;

/**
 * Class CarTransferRepository
 * @package App\Repositories
 * @version February 22, 2022, 4:06 pm UTC
*/

class CarTransferRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'names',
        'email',
        'phone_number',
        'pickup_location',
        'pickup_date',
        'pickup_time',
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
        return CarTransfer::class;
    }
}
