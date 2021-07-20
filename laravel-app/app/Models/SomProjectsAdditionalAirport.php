<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsAdditionalAirport
 * @package App\Models
 * @version July 5, 2021, 9:37 am UTC
 *
 * @property \App\Models\SomProjectsAirport $somAirport
 * @property \App\Models\SomProject $somProject
 * @property integer $som_airport_id
 * @property integer $som_project_id
 */
class SomProjectsAdditionalAirport extends Model
{

    use HasFactory;

    public $table = 'som_projects_additional_airport';
    
    public $timestamps = false;




    public $fillable = [
        'som_airport_id',
        'som_project_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'som_airport_id' => 'integer',
        'som_project_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_airport_id' => 'required|exists:som_projects_airport,id', 
        'som_project_id' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somAirport()
    {
        return $this->belongsTo(\App\Models\SomProjectsAirport::class, 'som_airport_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somProject()
    {
        return $this->belongsTo(\App\Models\SomProject::class, 'som_project_id');
    }
}
