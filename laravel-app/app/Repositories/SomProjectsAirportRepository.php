<?php

namespace App\Repositories;

use App\Models\SomProjectsAirport;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsAirportRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:39 am UTC
*/

class SomProjectsAirportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SomProjectsAirport::class;
    }

    public function getLastInsertedId(){
        return $this->makeModel()
            ->max('id');
    }

    public function insertData($data){
        return $this->makeModel()
            ->insert($data);
    }

    public function updateData($id, $data){
        return $this->makeModel()
            ->where('id', $id)
            ->update($data);
    }

    public function getCountByCountryId($country_id){
        return $this->makeModel()
            ->where('som_country_id', $country_id)
            ->count();
    }

    public function getAllData(){
        $select  = array();
        $select[0] = 'som_projects_airport.*';
        $select[1] = 'som_projects_airport_type.name as som_projects_airport_type_name';
        $result = $this->makeModel()
            ->leftJoin('som_projects_airport_type', 'som_projects_airport.som_projects_airport_type_id', 'som_projects_airport_type.id')
            ->get($select);
        return $result;
    } 
}
