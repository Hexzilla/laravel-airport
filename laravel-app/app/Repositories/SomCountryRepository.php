<?php

namespace App\Repositories;

use App\Models\SomCountry;
use App\Repositories\BaseRepository;

/**
 * Class SomCountryRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:21 am UTC
*/

class SomCountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return SomCountry::class;
    }
}
