<?php

namespace App\Repositories;

use App\Models\SomProjectProcessType;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectProcessTypeRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:34 am UTC
*/

class SomProjectProcessTypeRepository extends BaseRepository
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
        return SomProjectProcessType::class;
    }
}
