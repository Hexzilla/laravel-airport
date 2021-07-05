<?php

namespace App\Repositories;

use App\Models\SomProjectsTransactionType;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsTransactionTypeRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:46 am UTC
*/

class SomProjectsTransactionTypeRepository extends BaseRepository
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
        return SomProjectsTransactionType::class;
    }
}
