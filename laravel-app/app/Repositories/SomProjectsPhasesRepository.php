<?php

namespace App\Repositories;

use App\Models\SomProjectsPhases;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsPhasesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:44 am UTC
*/

class SomProjectsPhasesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_projects_id',
        'som_phases_id',
        'order',
        'som_status_id'
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
        return SomProjectsPhases::class;
    }
}
