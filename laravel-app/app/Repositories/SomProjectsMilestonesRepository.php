<?php

namespace App\Repositories;

use App\Models\SomProjectsMilestones;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsMilestonesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:32 am UTC
*/

class SomProjectsMilestonesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_projects_phases_id',
        'blocking',
        'order',
        'due_date',
        'name',
        'som_status_id',
        'is_hidden'
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
        return SomProjectsMilestones::class;
    }

    public function getbreadcrumbsById($id){
        $select  = array();
        $select[0] = 'som_phases_milestones.*';
        $select[1] = 'som_phases.name as som_phases_name';
        $select[2] = 'som_projects.id as som_projects_id';
        $select[3] = 'som_projects.name as som_projects_name';
        $result = $this->makeModel()
            ->leftJoin('som_projects_phases', 'som_phases_milestones.som_projects_phases_id', 'som_projects_phases.id')
            ->leftJoin('som_phases', 'som_projects_phases.som_phases_id', 'som_phases.id')
            ->leftJoin('som_projects', 'som_projects_phases.som_projects_id', 'som_projects.id')
            ->where('som_phases_milestones.id', $id)
            ->get($select);
        return $result;
    }
}
