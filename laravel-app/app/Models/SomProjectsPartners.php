<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsPartners
 * @package App\Models
 * @version July 5, 2021, 9:43 am UTC
 *
 * @property \App\Models\SomProject $somProjects
 * @property string $name
 * @property integer $som_projects_id
 * @property string $company
 * @property string $company_profile
 * @property string $role_in_project
 * @property string $email
 * @property string $phone_number
 * @property string $other_information
 */
class SomProjectsPartners extends Model
{

    use HasFactory;

    public $table = 'som_projects_partners';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'som_projects_id',
        'company',
        'company_profile',
        'role_in_project',
        'email',
        'phone_number',
        'other_information'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'som_projects_id' => 'integer',
        'company' => 'string',
        'company_profile' => 'string',
        'role_in_project' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'other_information' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'som_projects_id' => 'required|integer',
        'company' => 'nullable|string|max:45',
        'company_profile' => 'nullable|string|max:45',
        'role_in_project' => 'nullable|string|max:45',
        'email' => 'nullable|string|max:250',
        'phone_number' => 'nullable|string|max:45',
        'other_information' => 'nullable|string|max:2000'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProjects()
    {
        return $this->belongsTo(\App\Models\SomProject::class, 'som_projects_id');
    }
}
