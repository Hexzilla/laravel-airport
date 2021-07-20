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
        'status',
        'photo',
        'name',
        'email',
        'job_title',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'string',
        'photo' => 'string',
        'name' => 'string',
        'email' => 'string',
        'job_title' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'status' => 'nullable|string|max:50',
        'name' => 'nullable|string|max:255',
        'photo' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:255',
        'job_title' => 'nullable|string|max:250',
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
