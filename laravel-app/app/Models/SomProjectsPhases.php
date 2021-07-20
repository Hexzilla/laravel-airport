<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsPhases
 * @package App\Models
 * @version July 5, 2021, 9:44 am UTC
 *
 * @property \App\Models\SomPhase $somPhases
 * @property \App\Models\SomProject $somProjects
 * @property \App\Models\SomStatus $somStatus
 * @property \Illuminate\Database\Eloquent\Collection $somPhasesMilestones
 * @property integer $som_projects_id
 * @property integer $som_phases_id
 * @property integer $order
 * @property integer $som_status_id
 */
class SomProjectsPhases extends Model
{

    use HasFactory;

    public $table = 'som_projects_phases';

    public $timestamps = false;




    public $fillable = [
        'som_projects_id',
        'som_phases_id',
        'order',
        'som_status_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'som_projects_id' => 'integer',
        'som_phases_id' => 'integer',
        'order' => 'integer',
        'som_status_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_projects_id' => 'required|integer',
        'som_phases_id' => 'required|integer',
        'order' => 'required|integer',
        'som_status_id' => 'nullable|integer|exists:som_status,id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somPhases()
    {
        return $this->belongsTo(\App\Models\SomPhases::class, 'som_phases_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjects()
    {
        return $this->belongsTo(\App\Models\SomProject::class, 'som_projects_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somStatus()
    {
        return $this->belongsTo(\App\Models\SomStatus::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somPhasesMilestones()
    {
        return $this->hasMany(\App\Models\SomPhasesMilestone::class, 'som_projects_phases_id');
    }
}