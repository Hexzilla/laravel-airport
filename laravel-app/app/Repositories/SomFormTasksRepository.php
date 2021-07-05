<?php

namespace App\Repositories;

use App\Models\SomFormTasks;
use App\Repositories\BaseRepository;

/**
 * Class SomFormTasksRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:27 am UTC
*/

class SomFormTasksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'duedate',
        'task_completion_date',
        'request_date',
        'comment',
        'tooltip',
        'support_doc_url',
        'support_doc_description',
        'som_status_id',
        'som_forms_id',
        'order',
        'som_departments_users_id',
        'som_departments_id',
        'is_sub_task',
        'cms_users_id',
        'cms_privileges_role_id',
        'consultable_user_name',
        'consultable_user_email'
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
        return SomFormTasks::class;
    }
}
