<?php

namespace App\Repositories;

use App\Models\SomProjectsAdvisors;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsAdvisorsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:38 am UTC
*/

class SomProjectsAdvisorsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'som_projects_id'
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
        return SomProjectsAdvisors::class;
    }
}
