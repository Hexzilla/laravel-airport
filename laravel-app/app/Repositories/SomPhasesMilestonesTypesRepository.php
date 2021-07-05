<?php

namespace App\Repositories;

use App\Models\SomPhasesMilestonesTypes;
use App\Repositories\BaseRepository;

/**
 * Class SomPhasesMilestonesTypesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:32 am UTC
*/

class SomPhasesMilestonesTypesRepository extends BaseRepository
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
        return SomPhasesMilestonesTypes::class;
    }
}
