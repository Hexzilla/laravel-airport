<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsModel
 * @package App\Models
 * @version July 5, 2021, 9:42 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somProjects
 * @property string $name
 */
class SomProjectsModel extends Model
{

    use HasFactory;

    public $table = 'som_projects_model';
    
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
        'name' => 'required|string|max:45'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjects()
    {
        return $this->hasMany(\App\Models\SomProject::class, 'som_projects_model_id');
    }
}
