<?php

namespace App\Repositories;

use App\Models\SomProjectsPriority;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsPriorityRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:45 am UTC
*/

class SomProjectsPriorityRepository extends BaseRepository
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
        return SomProjectsPriority::class;
    }
}
