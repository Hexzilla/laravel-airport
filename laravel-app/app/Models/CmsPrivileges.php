<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CmsPrivileges
 * @package App\Models
 * @version July 5, 2021, 9:10 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somApprovalsResponsibles
 * @property \Illuminate\Database\Eloquent\Collection $somApprovalsResponsible1s
 * @property \Illuminate\Database\Eloquent\Collection $somFormElements
 * @property \Illuminate\Database\Eloquent\Collection $somFormTasks
 * @property \Illuminate\Database\Eloquent\Collection $somProjectUsers
 * @property string $name
 * @property boolean $is_superadmin
 * @property string $theme_color
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property boolean $is_app_role
 * @property boolean $is_project_role
 */
class CmsPrivileges extends Model
{

    use HasFactory;

    public $table = 'cms_privileges';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'is_superadmin',
        'theme_color',
        'created_at',
        'updated_at',
        'is_app_role',
        'is_project_role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'is_superadmin' => 'boolean',
        'theme_color' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_app_role' => 'boolean',
        'is_project_role' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'is_superadmin' => 'nullable|boolean',
        'theme_color' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'is_app_role' => 'nullable|boolean',
        'is_project_role' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somApprovalsResponsibles()
    {
        return $this->hasMany(\App\Models\SomApprovalsResponsible::class, 'cms_privilege_id_assigned');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somApprovalsResponsible1s()
    {
        return $this->hasMany(\App\Models\SomApprovalsResponsible::class, 'cms_privilege_id_notify');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormElements()
    {
        return $this->hasMany(\App\Models\SomFormElement::class, 'cms_privileges_role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormTasks()
    {
        return $this->hasMany(\App\Models\SomFormTask::class, 'cms_privileges_role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectUsers()
    {
        return $this->hasMany(\App\Models\SomProjectUser::class, 'cms_privileges_id');
    }
}
