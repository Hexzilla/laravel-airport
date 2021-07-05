<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomStatus
 * @package App\Models
 * @version July 5, 2021, 9:47 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somApprovalsResponsibles
 * @property \Illuminate\Database\Eloquent\Collection $somFormTasks
 * @property \Illuminate\Database\Eloquent\Collection $somForms
 * @property \Illuminate\Database\Eloquent\Collection $somPhasesMilestones
 * @property \Illuminate\Database\Eloquent\Collection $somProjects
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsPhases
 * @property \Illuminate\Database\Eloquent\Collection $somStatusApprovals
 * @property string $hex_color
 * @property string $name
 * @property string $type
 * @property string $icon
 * @property string $display_text
 * @property boolean $is_behaviour_completed
 * @property boolean $is_behaviour_rejected
 * @property boolean $is_behaviour_ongoing
 * @property boolean $is_behaviour_review
 */
class SomStatus extends Model
{

    use HasFactory;

    public $table = 'som_status';
    
    public $timestamps = false;




    public $fillable = [
        'hex_color',
        'name',
        'type',
        'icon',
        'display_text',
        'is_behaviour_completed',
        'is_behaviour_rejected',
        'is_behaviour_ongoing',
        'is_behaviour_review'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'hex_color' => 'string',
        'name' => 'string',
        'type' => 'string',
        'icon' => 'string',
        'display_text' => 'string',
        'is_behaviour_completed' => 'boolean',
        'is_behaviour_rejected' => 'boolean',
        'is_behaviour_ongoing' => 'boolean',
        'is_behaviour_review' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'hex_color' => 'required|string|max:8',
        'name' => 'nullable|string|max:255',
        'type' => 'required|string|max:45',
        'icon' => 'nullable|string|max:255',
        'display_text' => 'nullable|string|max:45',
        'is_behaviour_completed' => 'nullable|boolean',
        'is_behaviour_rejected' => 'nullable|boolean',
        'is_behaviour_ongoing' => 'nullable|boolean',
        'is_behaviour_review' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somApprovalsResponsibles()
    {
        return $this->hasMany(\App\Models\SomApprovalsResponsible::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somFormTasks()
    {
        return $this->hasMany(\App\Models\SomFormTask::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somForms()
    {
        return $this->hasMany(\App\Models\SomForm::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somPhasesMilestones()
    {
        return $this->hasMany(\App\Models\SomPhasesMilestone::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjects()
    {
        return $this->hasMany(\App\Models\SomProject::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsPhases()
    {
        return $this->hasMany(\App\Models\SomProjectsPhase::class, 'som_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somStatusApprovals()
    {
        return $this->hasMany(\App\Models\SomStatusApproval::class, 'som_status_id');
    }
}
