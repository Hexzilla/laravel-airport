<?php

namespace App\Repositories;

use App\Models\SomProjectsAdditionalAirport;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsAdditionalAirportRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:37 am UTC
*/

class SomProjectsAdditionalAirportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_airport_id',
        'som_project_id'
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
        return SomProjectsAdditionalAirport::class;
    }
}
