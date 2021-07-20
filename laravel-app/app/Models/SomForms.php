<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomForms
 * @package App\Models
 * @version July 5, 2021, 9:28 am UTC
 *
 * @property \App\Models\SomPhasesMilestone $somPhasesMilestones
 * @property \App\Models\SomStatus $somStatus
 * @property \App\Models\SomMilestonesFormsType $somMilestonesFormsTypes
 * @property \Illuminate\Database\Eloquent\Collection $somFormApprovals
 * @property \Illuminate\Database\Eloquent\Collection $somFormElements
 * @property \Illuminate\Database\Eloquent\Collection $somFormTasks
 * @property string $name
 * @property integer $active
 * @property integer $som_phases_milestones_id
 * @property integer $order_form
 * @property integer $som_milestones_forms_types_id
 * @property integer $som_status_id
 * @property boolean $is_inactive
 */
class SomForms extends Model
{

    use HasFactory;

    public $table = 'som_forms';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'active',
        'som_phases_milestones_id',
        'order_form',
        'som_milestones_forms_types_id',
        'som_status_id',
        'is_inactive'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'active' => 'integer',
        'som_phases_milestones_id' => 'integer',
        'order_form' => 'integer',
        'som_milestones_forms_types_id' => 'integer',
        'som_status_id' => 'integer',
        'is_inactive' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'active' => 'nullable|integer',
        'som_phases_milestones_id' => 'required|integer',
        'order_form' => 'required|integer',
        'som_milestones_forms_types_id' => 'required|integer|min:1',
        'som_status_id' => 'nullable|integer',
        'is_inactive' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somPhasesMilestones()
    {
        return $this->belongsTo(\App\Models\SomPhasesMilestone::class, 'som_phases_milestones_id');
    }

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
    public function somMilestonesFormsTypes()
    {
        return $this->belongsTo(\App\Models\SomMilestonesFormsType::class, 'som_milestones_forms_types_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormApprovals()
    {
        return $this->hasMany(\App\Models\SomFormApproval::class, 'som_forms_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormElements()
    {
        return $this->hasMany(\App\Models\SomFormElement::class, 'som_forms_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormTasks()
    {
        return $this->hasMany(\App\Models\SomFormTask::class, 'som_forms_id');
    }
}
