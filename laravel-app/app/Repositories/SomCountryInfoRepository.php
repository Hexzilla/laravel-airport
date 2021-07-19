<?php

namespace App\Repositories;

use App\Models\SomCountryInfo;
use App\Repositories\BaseRepository;

/**
 * Class SomCountryInfoRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:22 am UTC
*/

class SomCountryInfoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_country_id',
        'year',
        'population',
        'inflation',
        'gpd_evolution'
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
        return SomCountryInfo::class;
    }

    public function getCountByCountryId($country_id){
        return $this->makeModel()
            ->where('som_country_id', $country_id)
            ->count();
    }

    public function insertData($data){
        return $this->makeModel()
            ->insert($data);
    }

    public function getAllData(){
        $select  = array();
        $select[0] = 'som_country_info.*';
        $select[1] = 'som_country.country as som_country_name';
        $result = $this->makeModel()
            ->leftJoin('som_country', 'som_country_info.som_country_id', 'som_country.id')
            ->get($select);
        return $result;
    }
}
