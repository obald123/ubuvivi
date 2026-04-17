<?php

namespace App\Repositories\Types;

use App\Models\Types\Transmission;
use App\Repositories\BaseRepository;

/**
 * Class TransmissionRepository
 * @package App\Repositories\Types
 * @version February 2, 2022, 2:21 pm UTC
*/

class TransmissionRepository extends BaseRepository
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
        return Transmission::class;
    }
}
