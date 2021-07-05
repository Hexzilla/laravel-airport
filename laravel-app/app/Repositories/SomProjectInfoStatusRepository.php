<?php

namespace App\Repositories;

use App\Models\SomProjectInfoStatus;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectInfoStatusRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:33 am UTC
*/

class SomProjectInfoStatusRepository extends BaseRepository
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
        return SomProjectInfoStatus::class;
    }
}
