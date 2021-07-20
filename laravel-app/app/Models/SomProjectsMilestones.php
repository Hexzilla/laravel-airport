<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsMilestones
 * @package App\Models
 * @version July 5, 2021, 9:32 am UTC
 *
 * @property \App\Models\SomStatus $somStatus
 * @property \App\Models\SomProjectsPhase $somProjectsPhases
 * @property \Illuminate\Database\Eloquent\Collection $somForms
 * @property integer $som_projects_phases_id
 * @property integer $blocking
 * @property integer $order
 * @property string $due_date
 * @property string $name
 * @property integer $som_status_id
 * @property boolean $is_hidden
 */
class SomProjectsMilestones extends Model
{

    use HasFactory;

    public $table = 'som_phases_milestones';
    
    public $timestamps = false;




    public $fillable = [
        'som_projects_phases_id',
        'blocking',
        'order',
        'due_date',
        'name',
        'som_status_id',
        'is_hidden'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'som_projects_phases_id' => 'integer',
        'blocking' => 'integer',
        'order' => 'integer',
        'due_date' => 'date',
        'name' => 'string',
        'som_status_id' => 'integer',
        'is_hidden' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_projects_phases_id' => 'required|integer',
        'blocking' => 'nullable|integer',
        'order' => 'required|integer',
        'due_date' => 'required|date',
        'name' => 'required|string|max:255',
        'som_status_id' => 'nullable|integer',
        'is_hidden' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somStatus()
    {
        return $this->belongsTo(\App\Models\SomStatus::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectsPhases()
    {
        return $this->belongsTo(\App\Models\SomProjectsPhase::class, 'som_projects_phases_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somForms()
    {
        return $this->hasMany(\App\Models\SomForm::class, 'som_phases_milestones_id');
    }
}
