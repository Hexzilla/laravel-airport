<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomFormTasks
 * @package App\Models
 * @version July 5, 2021, 9:27 am UTC
 *
 * @property \App\Models\CmsPrivilege $cmsPrivilegesRole
 * @property \App\Models\CmsUsers $cmsUsers
 * @property \App\Models\SomDepartmentsUser $somDepartmentsUsers
 * @property \App\Models\SomForm $somForms
 * @property \App\Models\SomStatus $somStatus
 * @property string $name
 * @property string $duedate
 * @property string $task_completion_date
 * @property string $request_date
 * @property string $comment
 * @property string $tooltip
 * @property string $support_doc_url
 * @property string $support_doc_description
 * @property integer $som_status_id
 * @property integer $som_forms_id
 * @property integer $order
 * @property integer $som_departments_users_id
 * @property integer $som_departments_id
 * @property boolean $is_sub_task
 * @property integer $cms_users_id
 * @property integer $cms_privileges_role_id
 * @property string $consultable_user_name
 * @property string $consultable_user_email
 */
class SomFormTasks extends Model
{

    use HasFactory;

    public $table = 'som_form_tasks';

    public $timestamps = false;




    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'duedate' => 'date',
        'task_completion_date' => 'date',
        'request_date' => 'date',
        'comment' => 'string',
        'tooltip' => 'string',
        'support_doc_url' => 'string',
        'support_doc_description' => 'string',
        'som_status_id' => 'integer',
        'som_forms_id' => 'integer',
        'order' => 'integer',
        'som_departments_users_id' => 'integer',
        'som_departments_id' => 'integer',
        'is_sub_task' => 'integer',
        'cms_users_id' => 'integer',
        'cms_privileges_role_id' => 'integer',
        'consultable_user_name' => 'string',
        'consultable_user_email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:500|min:3',
        'duedate' => 'nullable',
        'task_completion_date' => 'nullable',
        'request_date' => 'nullable',
        'comment' => 'nullable|string|max:255',
        'tooltip' => 'nullable|string|max:2000',
        'support_doc_url' => 'nullable|string|max:1000',
        'support_doc_description' => 'nullable|string|max:255',
        'som_status_id' => 'nullable|integer|min:0',
        'som_forms_id' => 'required|integer',
        'order' => 'required|integer|min:0',
        'som_departments_users_id' => 'nullable|integer',
        'som_departments_id' => 'nullable|integer|min:0',
        'is_sub_task' => 'required|integer|min:0',
        'cms_users_id' => 'nullable|integer',
        'cms_privileges_role_id' => 'required|integer|min:1',
        'consultable_user_name' => 'nullable|string|max:200',
        'consultable_user_email' => 'nullable|string|max:200'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cmsPrivilegesRole()
    {
        return $this->belongsTo(\App\Models\CmsPrivilege::class, 'cms_privileges_role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cmsUsers()
    {
        return $this->belongsTo(\App\Models\CmsUsers::class, 'cms_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somDepartmentsUsers()
    {
        return $this->belongsTo(\App\Models\SomDepartmentsUser::class, 'som_departments_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somForms()
    {
        return $this->belongsTo(\App\Models\SomForm::class, 'som_forms_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somStatus()
    {
        return $this->belongsTo(\App\Models\SomStatus::class, 'som_status_id');
    }
}
