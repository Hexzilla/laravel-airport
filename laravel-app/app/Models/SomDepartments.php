<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomDepartments
 * @package App\Models
 * @version July 5, 2021, 9:23 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somDepartmentsUsers
 * @property string $name
 */
class SomDepartments extends Model
{

    use HasFactory;

    public $table = 'som_departments';
    
    public $timestamps = false;




    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somDepartmentsUsers()
    {
        return $this->hasMany(\App\Models\SomDepartmentsUser::class, 'som_departments_id');
    }
}
