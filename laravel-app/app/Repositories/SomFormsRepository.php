<?php

namespace App\Repositories;

use App\Models\SomForms;
use App\Repositories\BaseRepository;

/**
 * Class SomFormsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:28 am UTC
*/

class SomFormsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'active',
        'som_phases_milestones_id',
        'order_form',
        'som_milestones_forms_types_id',
        'som_status_id',
        'is_inactive'
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
        return SomForms::class;
    }

    public function getbreadcrumbsById($id){
        $select  = array();
        $select[0] = 'som_forms.*';
        $select[1] = 'som_phases_milestones.name as som_phases_milestones_name';
        $select[2] = 'som_projects_phases.id as som_projects_phases_id';
        $select[3] = 'som_phases.name as som_phases_name';
        $select[4] = 'som_projects.id as som_projects_id';
        $select[5] = 'som_projects.name as som_projects_name';
        $result = $this->makeModel()
            ->leftJoin('som_phases_milestones','som_forms.som_phases_milestones_id','som_phases_milestones.id')
            ->leftJoin('som_projects_phases', 'som_phases_milestones.som_projects_phases_id', 'som_projects_phases.id')
            ->leftJoin('som_phases', 'som_projects_phases.som_phases_id', 'som_phases.id')
            ->leftJoin('som_projects', 'som_projects_phases.som_projects_id', 'som_projects.id')
            ->where('som_forms.id', $id)
            ->get($select);
        return $result;
    }
}
