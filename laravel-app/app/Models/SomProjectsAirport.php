<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SomProjectsAirport
 * @package App\Models
 * @version July 5, 2021, 9:39 am UTC
 *
 * @property \App\Models\SomCountry $somCountry
 * @property \App\Models\SomProjectsAirportType $somProjectsAirportType
 * @property \Illuminate\Database\Eloquent\Collection $somProjects
 * @property \Illuminate\Database\Eloquent\Collection $somProjectsAdditionalAirports
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $country
 * @property number $lat
 * @property number $long
 * @property string $iata_oaci
 * @property integer $som_projects_airport_type_id
 * @property number $size
 * @property number $revenues_aeronautical
 * @property number $revenues_non_aeronautical
 * @property number $total_revenues
 * @property number $total_opex
 * @property number $ebitda
 * @property number $kpi_revenues_aeronautical
 * @property number $kpi_revenues_non_aeronautical
 * @property number $kpi_ebitda
 * @property number $percentage_international
 * @property number $percentage_transfer
 * @property number $percentage_non_low_cost
 * @property string $infrastructure_characterization_description
 * @property string $airport_catchment_area
 * @property string $competitors
 * @property string $top1_airline
 * @property string $top2_airline
 * @property string $top3_airline
 * @property number $top1_airline_percentage
 * @property number $top2_airline_percentage
 * @property number $top3_airline_percentage
 * @property string $route
 * @property string $master_plan_estimations
 * @property string $society_model_regulation
 * @property string $aena_network_improvement
 * @property number $debt_ebitda
 * @property string $img_url
 * @property integer $som_country_id
 * @property string $other_info
 * @property integer $data_year
 * @property string $version_date
 */
class SomProjectsAirport extends Model
{

    use HasFactory;

    public $table = 'som_projects_airport';
    
    public $timestamps = false;




    public $fillable = [
        'name',
        'address',
        'city',
        'country',
        'lat',
        'long',
        'iata_oaci',
        'som_projects_airport_type_id',
        'size',
        'revenues_aeronautical',
        'revenues_non_aeronautical',
        'total_revenues',
        'total_opex',
        'ebitda',
        'kpi_revenues_aeronautical',
        'kpi_revenues_non_aeronautical',
        'kpi_ebitda',
        'percentage_international',
        'percentage_transfer',
        'percentage_non_low_cost',
        'infrastructure_characterization_description',
        'airport_catchment_area',
        'competitors',
        'top1_airline',
        'top2_airline',
        'top3_airline',
        'top1_airline_percentage',
        'top2_airline_percentage',
        'top3_airline_percentage',
        'route',
        'master_plan_estimations',
        'society_model_regulation',
        'aena_network_improvement',
        'debt_ebitda',
        'img_url',
        'som_country_id',
        'other_info',
        'data_year',
        'version_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'address' => 'string',
        'city' => 'string',
        'country' => 'string',
        'lat' => 'decimal:17',
        'long' => 'decimal:17',
        'iata_oaci' => 'string',
        'som_projects_airport_type_id' => 'integer',
        'size' => 'decimal:2',
        'revenues_aeronautical' => 'decimal:2',
        'revenues_non_aeronautical' => 'decimal:2',
        'total_revenues' => 'decimal:2',
        'total_opex' => 'decimal:2',
        'ebitda' => 'decimal:2',
        'kpi_revenues_aeronautical' => 'decimal:2',
        'kpi_revenues_non_aeronautical' => 'decimal:2',
        'kpi_ebitda' => 'decimal:2',
        'percentage_international' => 'decimal:2',
        'percentage_transfer' => 'decimal:2',
        'percentage_non_low_cost' => 'decimal:2',
        'infrastructure_characterization_description' => 'string',
        'airport_catchment_area' => 'string',
        'competitors' => 'string',
        'top1_airline' => 'string',
        'top2_airline' => 'string',
        'top3_airline' => 'string',
        'top1_airline_percentage' => 'decimal:2',
        'top2_airline_percentage' => 'decimal:2',
        'top3_airline_percentage' => 'decimal:2',
        'route' => 'string',
        'master_plan_estimations' => 'string',
        'society_model_regulation' => 'string',
        'aena_network_improvement' => 'string',
        'debt_ebitda' => 'decimal:2',
        'img_url' => 'string',
        'som_country_id' => 'integer',
        'other_info' => 'string',
        'data_year' => 'integer',
        'version_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:245|min:3',
        'address' => 'required|string|max:245|min:5',
        'city' => 'nullable|string|max:45',
        'country' => 'nullable|string|max:45',
        'lat' => 'nullable|numeric|min:0',
        'long' => 'nullable|numeric|min:0',
        'iata_oaci' => 'nullable|string|max:45|min:1',
        'som_projects_airport_type_id' => 'nullable|integer|min:0',
        'size' => 'required|numeric|min:0',
        'revenues_aeronautical' => 'nullable|numeric|min:0',
        'revenues_non_aeronautical' => 'nullable|numeric|min:0',
        'total_revenues' => 'nullable|numeric|min:0',
        'total_opex' => 'nullable|numeric|min:0',
        'ebitda' => 'nullable|numeric|min:0',
        'kpi_revenues_aeronautical' => 'nullable|numeric|min:0',
        'kpi_revenues_non_aeronautical' => 'nullable|numeric|min:0',
        'kpi_ebitda' => 'nullable|numeric|min:0',
        'percentage_international' => 'nullable|numeric|min:0',
        'percentage_transfer' => 'nullable|numeric|min:0',
        'percentage_non_low_cost' => 'nullable|numeric|min:0',
        'infrastructure_characterization_description' => 'nullable|string|max:250',
        'airport_catchment_area' => 'nullable|string|max:255',
        'competitors' => 'nullable|string|max:250',
        'top1_airline' => 'nullable|string|max:50',
        'top2_airline' => 'nullable|string|max:50',
        'top3_airline' => 'nullable|string|max:50',
        'top1_airline_percentage' => 'nullable|numeric|min:0',
        'top2_airline_percentage' => 'nullable|numeric|min:0',
        'top3_airline_percentage' => 'nullable|numeric|min:0',
        'route' => 'nullable|string|max:250',
        'master_plan_estimations' => 'nullable|string|max:250',
        'society_model_regulation' => 'nullable|string|max:250',
        'aena_network_improvement' => 'nullable|string|max:250',
        'debt_ebitda' => 'nullable|numeric|min:0',
        'img_url' => 'nullable|string|max:1000',
        'som_country_id' => 'nullable|integer|min:0',
        'other_info' => 'nullable|string|max:250',
        'data_year' => 'nullable|integer|min:0',
        'version_date' => 'nullable'
    ];


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
    public function somProjectsAirportType()
    {
        return $this->belongsTo(\App\Models\SomProjectsAirportType::class, 'som_projects_airport_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjects()
    {
        return $this->hasMany(\App\Models\SomProject::class, 'som_projects_airport_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function somProjectsAdditionalAirports()
    {
        return $this->hasMany(\App\Models\SomProjectsAdditionalAirport::class, 'som_airport_id');
    }
}
