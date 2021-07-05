<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsAdvisors
 * @package App\Models
 * @version July 5, 2021, 9:38 am UTC
 *
 * @property \App\Models\SomProject $somProjects
 * @property string $name
 * @property integer $som_projects_id
 */
class SomProjectsAdvisors extends Model
{

    use HasFactory;

    public $table = 'som_projects_advisors';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'som_projects_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'som_projects_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'som_projects_id' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjects()
    {
        return $this->belongsTo(\App\Models\SomProject::class, 'som_projects_id');
    }
}
