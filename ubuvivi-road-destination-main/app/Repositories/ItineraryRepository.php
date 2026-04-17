<?php

namespace App\Repositories;

use App\Models\Itinerary;
use App\Repositories\BaseRepository;

/**
 * Class ItineraryRepository
 * @package App\Repositories
 * @version February 24, 2022, 2:24 pm UTC
*/

class ItineraryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'images',
        'highlights',
        'days_description',
        'inclusions',
        'exclusions'
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
        return Itinerary::class;
    }
}
