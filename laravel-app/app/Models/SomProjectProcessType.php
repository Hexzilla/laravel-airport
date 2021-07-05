<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectProcessType
 * @package App\Models
 * @version July 5, 2021, 9:34 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somProjects
 * @property string $name
 */
class SomProjectProcessType extends Model
{

    use HasFactory;

    public $table = 'som_project_process_type';
    
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
        'name' => 'nullable|string|max:55'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjects()
    {
        return $this->hasMany(\App\Models\SomProject::class, 'som_project_process_type_id');
    }
}
