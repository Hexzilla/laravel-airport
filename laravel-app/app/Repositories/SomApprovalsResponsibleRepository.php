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
}
