<?php

namespace App\Repositories;

use App\Models\Package;
use App\Repositories\BaseRepository;

/**
 * Class PackageRepository
 * @package App\Repositories
 * @version February 22, 2022, 4:03 pm UTC
*/

class PackageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'prices',
        'custom_prices'
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
        return Package::class;
    }
}
