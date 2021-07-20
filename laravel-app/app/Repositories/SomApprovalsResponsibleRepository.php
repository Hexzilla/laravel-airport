<?php

namespace App\Repositories;

use App\Models\SomApprovalsResponsible;
use App\Repositories\BaseRepository;

/**
 * Class SomApprovalsResponsibleRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:20 am UTC
*/

class SomApprovalsResponsibleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'lastupdate',
        'comment',
        'som_form_approvals_id',
        'som_status_id',
        'document_url',
        'doc_url_description',
        'order_approval',
        'is_final_approval',
        'cms_privilege_id_assigned',
        'cms_privilege_id_notify'
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
        return SomApprovalsResponsible::class;
    }

    public function getAllData($som_form_approvals_id){
        $select  = array();
        $select[0] = 'som_approvals_responsible.*';
        $select[1] = 'som_form_approvals.name as som_form_approvals_name';
        $select[2] = 'cpa.name as cms_privileges_assigned_name';
        $select[3] = 'cpn.name as cms_privileges_notify_name';
        $result = $this->makeModel()
            ->leftJoin('som_form_approvals', 'som_approvals_responsible.som_form_approvals_id', 'som_form_approvals.id')
            ->leftJoin('cms_privileges as cpa', 'som_approvals_responsible.cms_privilege_id_assigned', 'cpa.id')
            ->leftJoin('cms_privileges as cpn', 'som_approvals_responsible.cms_privilege_id_notify', 'cpn.id')
            ->where('som_approvals_responsible.som_form_approvals_id', $som_form_approvals_id)
            ->get($select);
        return $result;
    }

    public function getbreadcrumbsById($id){
        $select  = array();
        $select[0] = 'som_approvals_responsible.*';
        $select[1] = 'som_form_approvals.name as som_form_approvals_name';
        $select[2] = 'som_forms.id as som_forms_id';
        $select[3] = 'som_forms.name as som_forms_name';
        $select[4] = 'som_phases_milestones.id as som_phases_milestones_id';
        $select[5] = 'som_phases_milestones.name as som_phases_milestones_name';
        $select[6] = 'som_projects_phases.id as som_projects_phases_id';
        $select[7] = 'som_phases.name as som_phases_name';
        $select[8] = 'som_projects.id as som_projects_id';
        $select[9] = 'som_projects.name as som_projects_name';
        $result = $this->makeModel()
            ->leftJoin('som_form_approvals','som_approvals_responsible.som_form_approvals_id','som_form_approvals.id')
            ->leftJoin('som_forms','som_form_approvals.som_forms_id','som_forms.id')
            ->leftJoin('som_phases_milestones','som_forms.som_phases_milestones_id','som_phases_milestones.id')
            ->leftJoin('som_projects_phases', 'som_phases_milestones.som_projects_phases_id', 'som_projects_phases.id')
            ->leftJoin('som_phases', 'som_projects_phases.som_phases_id', 'som_phases.id')
            ->leftJoin('som_projects', 'som_projects_phases.som_projects_id', 'som_projects.id')
            ->where('som_approvals_responsible.id', $id)
            ->get($select);
        return $result;
    }
}
