<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class CmsUsers
 * @package App\Models
 * @version July 5, 2021, 9:17 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somDepartmentsUsers
 * @property \Illuminate\Database\Eloquent\Collection $somFormTasks
 * @property \Illuminate\Database\Eloquent\Collection $somProjectUsers
 * @property string $name
 * @property string $photo
 * @property string $email
 * @property string $password
 * @property integer $id_cms_privileges
 * @property string|\Carbon\Carbon $created_at
 * @property string|\Carbon\Carbon $updated_at
 * @property string $status
 * @property string $job_title
 * @property string $objectguid
 */
class CmsUsers  extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'cms_users';

    public $timestamps = false;

    public $fillable = [
        'name',
        'photo',
        'email',
        'password',
        'id_cms_privileges',
        'created_at',
        'updated_at',
        'status',
        'job_title',
        'objectguid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'photo' => 'string',
        'email' => 'string',
        'password' => 'string',
        'id_cms_privileges' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'string',
        'job_title' => 'string',
        'objectguid' => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'photo' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:255',
        'password' => 'nullable|string|max:255',
        'id_cms_privileges' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'status' => 'nullable|string|max:50',
        'job_title' => 'nullable|string|max:250',
        'objectguid' => 'nullable|string|max:100'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somDepartmentsUsers()
    {
        return $this->hasMany(\App\Models\SomDepartmentsUser::class, 'cms_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormTasks()
    {
        return $this->hasMany(\App\Models\SomFormTask::class, 'cms_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectUsers()
    {
        return $this->hasMany(\App\Models\SomProjectUser::class, 'cms_users_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
