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
}
