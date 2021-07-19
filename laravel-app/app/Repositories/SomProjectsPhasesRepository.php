<?php

namespace App\Repositories;

use App\Models\SomProjectsPhases;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsPhasesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:44 am UTC
*/

class SomProjectsPhasesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_projects_id',
        'som_phases_id',
        'order',
        'som_status_id'
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
        return SomProjectsPhases::class;
    }

    public function getDataBySomProjectsId($som_projects_id){
        $select  = array();
        $select[0] = 'som_projects_phases.*';
        $select[1] = 'som_phases.name as som_phases_name';
        $result = $this->makeModel()
            ->leftJoin('som_phases', 'som_projects_phases.som_phases_id', 'som_phases.id')
            ->where('som_projects_phases.som_projects_id', $som_projects_id)
            ->get($select);
        return $result;
    }

    public function getbreadcrumbsById($id){
        $select  = array();
        $select[0] = 'som_projects_phases.*';
        $select[1] = 'som_phases.name as som_phases_name';
        $select[2] = 'som_projects.name as som_projects_name';
        $result = $this->makeModel()
            ->leftJoin('som_phases', 'som_projects_phases.som_phases_id', 'som_phases.id')
            ->leftJoin('som_projects', 'som_projects_phases.som_projects_id', 'som_projects.id')
            ->where('som_projects_phases.id', $id)
            ->get($select);
        return $result;
    }
}
