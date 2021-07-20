<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomCountryInfo
 * @package App\Models
 * @version July 5, 2021, 9:22 am UTC
 *
 * @property \App\Models\SomCountry $somCountry
 * @property integer $som_country_id
 * @property string $year
 * @property number $population
 * @property number $inflation
 * @property number $gpd_evolution
 */
class SomCountryInfo extends Model
{

    use HasFactory;

    public $table = 'som_country_info';
    
    public $timestamps = false;




    public $fillable = [
        'som_country_id',
        'year',
        'population',
        'inflation',
        'gpd_evolution'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'som_country_id' => 'integer',
        'year' => 'string',
        'population' => 'decimal:2',
        'inflation' => 'decimal:2',
        'gpd_evolution' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'som_country_id' => 'required|integer',
        'year' => 'required',
        'population' => 'nullable|numeric',
        'inflation' => 'nullable|numeric',
        'gpd_evolution' => 'nullable|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function somCountry()
    {
        return $this->belongsTo(\App\Models\SomCountry::class, 'som_country_id');
    }
}
