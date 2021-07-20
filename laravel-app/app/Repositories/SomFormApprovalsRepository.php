<?php

namespace App\Repositories;

use App\Models\SomFormApprovals;
use App\Repositories\BaseRepository;

/**
 * Class SomFormApprovalsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:25 am UTC
*/

class SomFormApprovalsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'som_forms_id',
        'order_approval'
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
        return SomFormApprovals::class;
    }

    public function getbreadcrumbsById($id){
        $select  = array();
        $select[0] = 'som_form_approvals.*';
        $select[1] = 'som_forms.name as som_forms_name';
        $select[2] = 'som_phases_milestones.id as som_phases_milestones_id';
        $select[3] = 'som_phases_milestones.name as som_phases_milestones_name';
        $select[4] = 'som_projects_phases.id as som_projects_phases_id';
        $select[5] = 'som_phases.name as som_phases_name';
        $select[6] = 'som_projects.id as som_projects_id';
        $select[7] = 'som_projects.name as som_projects_name';
        $result = $this->makeModel()
            ->leftJoin('som_forms','som_form_approvals.som_forms_id','som_forms.id')
            ->leftJoin('som_phases_milestones','som_forms.som_phases_milestones_id','som_phases_milestones.id')
            ->leftJoin('som_projects_phases', 'som_phases_milestones.som_projects_phases_id', 'som_projects_phases.id')
            ->leftJoin('som_phases', 'som_projects_phases.som_phases_id', 'som_phases.id')
            ->leftJoin('som_projects', 'som_projects_phases.som_projects_id', 'som_projects.id')
            ->where('som_form_approvals.id', $id)
            ->get($select);
        return $result;
    }
}
