<?php

namespace App\Repositories;

use App\Models\SomProjectsModel;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsModelRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:42 am UTC
*/

class SomProjectsModelRepository extends BaseRepository
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
        return SomProjectsModel::class;
    }
}
