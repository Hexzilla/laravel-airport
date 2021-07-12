<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomDepartmentsUsers
 * @package App\Models
 * @version July 5, 2021, 9:24 am UTC
 *
 * @property \App\Models\CmsUsers $cmsUsers
 * @property \App\Models\SomDepartment $somDepartments
 * @property \Illuminate\Database\Eloquent\Collection $somFormTasks
 * @property integer $som_departments_id
 * @property integer $cms_users_id
 */
class SomDepartmentsUsers extends Model
{

    use HasFactory;

    public $table = 'som_departments_users';

    public $timestamps = false;




    public $fillable = [
        'som_departments_id',
        'cms_users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'som_departments_id' => 'integer',
        'cms_users_id' => 'integer',
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_departments_id' => 'required|integer',
        'cms_users_id' => 'required|integer'
    ];

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
    public function somDepartments()
    {
        return $this->belongsTo(\App\Models\SomDepartment::class, 'som_departments_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormTasks()
    {
        return $this->hasMany(\App\Models\SomFormTask::class, 'som_departments_users_id');
    }
}
