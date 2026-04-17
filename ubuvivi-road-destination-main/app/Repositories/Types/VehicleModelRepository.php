<?php

namespace App\Repositories\Types;

use App\Models\Types\VehicleModel;
use App\Repositories\BaseRepository;

/**
 * Class VehicleModelRepository
 * @package App\Repositories\Types
 * @version February 2, 2022, 2:21 pm UTC
*/

class VehicleModelRepository extends BaseRepository
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
        return VehicleModel::class;
    }
}
