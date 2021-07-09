<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectUsers
 * @package App\Models
 * @version July 5, 2021, 9:35 am UTC
 *
 * @property \App\Models\CmsPrivilege $cmsPrivileges
 * @property \App\Models\CmsUsers $cmsUsers
 * @property \App\Models\SomProject $somProjects
 * @property integer $som_projects_id
 * @property integer $cms_users_id
 * @property integer $cms_privileges_id
 */
class SomProjectUsers extends Model
{

    use HasFactory;

    public $table = 'som_project_users';

    public $timestamps = false;




    public $fillable = [
        'som_projects_id',
        'cms_users_id',
        'cms_privileges_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'som_projects_id' => 'integer',
        'cms_users_id' => 'integer',
        'cms_privileges_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_projects_id' => 'required|integer',
        'cms_users_id' => 'required|integer',
        'cms_privileges_id' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cmsPrivileges()
    {
        return $this->belongsTo(\App\Models\CmsPrivilege::class, 'cms_privileges_id');
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
    public function somProjects()
    {
        return $this->belongsTo(\App\Models\SomProject::class, 'som_projects_id');
    }
}
