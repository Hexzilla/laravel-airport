<?php

namespace App\Repositories;

use App\Models\SomProjectsAirportType;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsAirportTypeRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:40 am UTC
*/

class SomProjectsAirportTypeRepository extends BaseRepository
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
        return SomProjectsAirportType::class;
    }
}
