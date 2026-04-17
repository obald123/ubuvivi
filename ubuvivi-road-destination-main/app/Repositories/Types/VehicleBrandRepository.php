<?php

namespace App\Repositories\Types;

use App\Models\Types\VehicleBrand;
use App\Repositories\BaseRepository;

/**
 * Class VehicleBrandRepository
 * @package App\Repositories\Types
 * @version February 2, 2022, 2:21 pm UTC
*/

class VehicleBrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return VehicleBrand::class;
    }
}
