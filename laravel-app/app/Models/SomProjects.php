<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjects
 * @package App\Models
 * @version July 5, 2021, 9:36 am UTC
 *
 * @property \App\Models\SomProjectInfoStatus $somProjectInfoStatus
 * @property \App\Models\SomProjectsPriority $somProjectPriority
 * @property \App\Models\SomProjectProcessType $somProjectProcessType
 * @property \App\Models\SomCountry $somCountry
 * @property \App\Models\SomProjectsAirport $somProjectsAirport
 * @property \App\Models\SomProjectsAssetType $somProjectsAssetType
 * @property \App\Models\SomProjectsModel $somProjectsModel
 * @property \App\Models\SomStatus $somStatus
 * @property \Illuminate\Database\Eloquent\Collection $somProjectUsers
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsAdditionalAirports
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsAdvisors
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsPartners
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsPhases
 * @property string $name
 * @property string $sub_name
 * @property string $grantor
 * @property string $concession_date_start
 * @property string $bid_presentation_date
 * @property number $equity
 * @property number $pr_length
 * @property boolean $is_template_project
 * @property integer $timeoffset
 * @property boolean $is_awarded
 * @property boolean $is_dismissed
 * @property string $contract_scope
 * @property string $deal_rational
 * @property string $other_requirements
 * @property number $valuation
 * @property string $solvency
 * @property string $documentation_folder
 * @property integer $som_status_id
 * @property integer $som_project_process_type_id
 * @property integer $som_project_priority_id
 * @property integer $som_project_info_status_id
 * @property integer $som_projects_model_id
 * @property integer $som_projects_asset_type_id
 * @property integer $som_projects_airport_id
 * @property integer $som_country_id
 * @property number $percentage_participation
 * @property string $ev
 * @property string $duration
 * @property string $responsibility
 * @property string $email_legal
 * @property string $email_finance
 * @property string $img_url
 */
class SomProjects extends Model
{

    use HasFactory;

    public $table = 'som_projects';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'sub_name',
        'grantor',
        'concession_date_start',
        'bid_presentation_date',
        'equity',
        'pr_length',
        'is_template_project',
        'timeoffset',
        'is_awarded',
        'is_dismissed',
        'contract_scope',
        'deal_rational',
        'other_requirements',
        'valuation',
        'solvency',
        'documentation_folder',
        'som_status_id',
        'som_project_process_type_id',
        'som_project_priority_id',
        'som_project_info_status_id',
        'som_projects_model_id',
        'som_projects_asset_type_id',
        'som_projects_airport_id',
        'som_country_id',
        'percentage_participation',
        'ev',
        'duration',
        'responsibility',
        'email_legal',
        'email_finance',
        'img_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'sub_name' => 'string',
        'grantor' => 'string',
        'concession_date_start' => 'date',
        'bid_presentation_date' => 'date',
        'equity' => 'decimal:2',
        'pr_length' => 'decimal:2',
        'is_template_project' => 'boolean',
        'timeoffset' => 'integer',
        'is_awarded' => 'boolean',
        'is_dismissed' => 'boolean',
        'contract_scope' => 'string',
        'deal_rational' => 'string',
        'other_requirements' => 'string',
        'valuation' => 'decimal:2',
        'solvency' => 'string',
        'documentation_folder' => 'string',
        'som_status_id' => 'integer',
        'som_project_process_type_id' => 'integer',
        'som_project_priority_id' => 'integer',
        'som_project_info_status_id' => 'integer',
        'som_projects_model_id' => 'integer',
        'som_projects_asset_type_id' => 'integer',
        'som_projects_airport_id' => 'integer',
        'som_country_id' => 'integer',
        'percentage_participation' => 'decimal:2',
        'ev' => 'string',
        'duration' => 'string',
        'responsibility' => 'string',
        'email_legal' => 'string',
        'email_finance' => 'string',
        'img_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'nullable|string|max:255',
        'sub_name' => 'nullable|string|max:1000',
        'grantor' => 'nullable|string|max:255',
        'concession_date_start' => 'nullable',
        'bid_presentation_date' => 'nullable',
        'equity' => 'nullable|numeric',
        'pr_length' => 'nullable|numeric',
        'is_template_project' => 'nullable|boolean',
        'timeoffset' => 'nullable|integer',
        'is_awarded' => 'nullable|boolean',
        'is_dismissed' => 'nullable|boolean',
        'contract_scope' => 'nullable|string|max:255',
        'deal_rational' => 'nullable|string|max:255',
        'other_requirements' => 'nullable|string|max:500',
        'valuation' => 'nullable|numeric',
        'solvency' => 'nullable|string|max:255',
        'documentation_folder' => 'nullable|string|max:100',
        'som_status_id' => 'nullable|integer',
        'som_project_process_type_id' => 'nullable|integer',
        'som_project_priority_id' => 'nullable|integer',
        'som_project_info_status_id' => 'nullable|integer',
        'som_projects_model_id' => 'nullable|integer',
        'som_projects_asset_type_id' => 'nullable|integer',
        'som_projects_airport_id' => 'nullable|integer',
        'som_country_id' => 'nullable|integer',
        'percentage_participation' => 'nullable|numeric',
        'ev' => 'nullable|string|max:10',
        'duration' => 'nullable|string|max:10',
        'responsibility' => 'nullable|string|max:10',
        'email_legal' => 'nullable|string|max:100',
        'email_finance' => 'nullable|string|max:100',
        'img_url' => 'nullable|string|max:2000'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectInfoStatus()
    {
        return $this->belongsTo(\App\Models\SomProjectInfoStatus::class, 'som_project_info_status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectPriority()
    {
        return $this->belongsTo(\App\Models\SomProjectsPriority::class, 'som_project_priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectProcessType()
    {
        return $this->belongsTo(\App\Models\SomProjectProcessType::class, 'som_project_process_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somCountry()
    {
        return $this->belongsTo(\App\Models\SomCountry::class, 'som_country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectsAirport()
    {
        return $this->belongsTo(\App\Models\SomProjectsAirport::class, 'som_projects_airport_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectsAssetType()
    {
        return $this->belongsTo(\App\Models\SomProjectsAssetType::class, 'som_projects_asset_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjectsModel()
    {
        return $this->belongsTo(\App\Models\SomProjectsModel::class, 'som_projects_model_id');
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
    public function somProjectUsers()
    {
        return $this->hasMany(\App\Models\SomProjectUser::class, 'som_projects_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsAdditionalAirports()
    {
        return $this->hasMany(\App\Models\SomProjectsAdditionalAirport::class, 'som_project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsAdvisors()
    {
        return $this->hasMany(\App\Models\SomProjectsAdvisor::class, 'som_projects_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsPartners()
    {
        return $this->hasMany(\App\Models\SomProjectsPartner::class, 'som_projects_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsPhases()
    {
        return $this->hasMany(\App\Models\SomProjectsPhase::class, 'som_projects_id');
    }
}
