<?php

namespace App\Repositories;

use App\Models\SomMilestonesFormsTypes;
use App\Repositories\BaseRepository;

/**
 * Class SomMilestonesFormsTypesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:29 am UTC
*/

class SomMilestonesFormsTypesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return SomMilestonesFormsTypes::class;
    }
}
