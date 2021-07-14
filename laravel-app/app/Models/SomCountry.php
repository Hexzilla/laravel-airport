<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomCountry
 * @package App\Models
 * @version July 5, 2021, 9:21 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $somCountryInfos
 * @property \Illuminate\Database\Eloquent\Collection $somProjects
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsAirports
 * @property string $country
 * @property string $country_code
 * @property string $description
 * @property integer $politics
 * @property integer $regulatory
 * @property integer $corruption
 * @property integer $business_easyness
 * @property integer $spain_affinity
 * @property string $aena_strategy_align
 * @property number $tourism_activity
 * @property string $country_risk
 * @property number $imports_exports
 * @property string $version_date
 * @property string $exchange_rate
 */
class SomCountry extends Model
{

    use HasFactory;

    public $table = 'som_country';
    
    public $timestamps = false;




    public $fillable = [
        'country',
        'country_code',
        'description',
        'politics',
        'regulatory',
        'corruption',
        'business_easyness',
        'spain_affinity',
        'aena_strategy_align',
        'tourism_activity',
        'country_risk',
        'imports_exports',
        'version_date',
        'exchange_rate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'country' => 'string',
        'country_code' => 'string',
        'description' => 'string',
        'politics' => 'integer',
        'regulatory' => 'integer',
        'corruption' => 'integer',
        'business_easyness' => 'integer',
        'spain_affinity' => 'integer',
        'aena_strategy_align' => 'string',
        'tourism_activity' => 'decimal:2',
        'country_risk' => 'string',
        'imports_exports' => 'decimal:2',
        'version_date' => 'date',
        'exchange_rate' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'country' => 'required|string|max:45|min:0',
        'country_code' => 'required|string|max:2',
        'description' => 'nullable|string|max:500',
        'politics' => 'nullable|integer|min:0|max:5',
        'regulatory' => 'nullable|integer|min:0|max:5',
        'corruption' => 'nullable|integer|min:0|max:5',
        'business_easyness' => 'nullable|integer|min:0|max:5',
        'spain_affinity' => 'nullable|integer|min:0|max:5',
        'aena_strategy_align' => 'nullable|string|max:3',
        'tourism_activity' => 'nullable|numeric|min:0|max:100',
        'country_risk' => 'nullable|string|max:10',
        'imports_exports' => 'nullable|numeric|min:0|max:99999999',
        'version_date' => 'nullable',
        'exchange_rate' => 'nullable|string|max:50'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somCountryInfos()
    {
        return $this->hasMany(\App\Models\SomCountryInfo::class, 'som_country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjects()
    {
        return $this->hasMany(\App\Models\SomProject::class, 'som_country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsAirports()
    {
        return $this->hasMany(\App\Models\SomProjectsAirport::class, 'som_country_id');
    }
}
