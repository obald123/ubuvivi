<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Repositories\BaseRepository;

/**
 * Class VehicleRepository
 * @package App\Repositories
 * @version February 2, 2022, 2:24 pm UTC
*/

class VehicleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'brand_id',
        'model_id',
        'production_year',
        'plate_number',
        'seats',
        'price',
        'currency',
        'transmission_id',
        'fuel_type_id',
        'one_day_caution',
        'other_caution',
        'location',
        'images',
        'properties',
        'approved',
        'for_sale',
        'on_lease',
        'sold'
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
        return Vehicle::class;
    }
}
