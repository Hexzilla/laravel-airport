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

    public function getCountByAirportId($airport_id){
        return $this->makeModel()
            ->where('som_airport_id', $airport_id)
            ->count();
    }

    public function getAllData($som_project_id){
        $select  = array();
        $select[0] = 'som_projects_additional_airport.*';
        $select[1] = 'som_projects_airport.name as som_projects_airport_name';
        $result = $this->makeModel()
            ->leftJoin('som_projects_airport', 'som_projects_additional_airport.som_airport_id', 'som_projects_airport.id')
            ->where('som_projects_additional_airport.som_project_id', $som_project_id)
            ->get($select);
        return $result;
    }
}
