<?php

namespace App\Repositories;

use App\Models\SomProjectsMilestones;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsMilestonesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:32 am UTC
*/

class SomProjectsMilestonesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_projects_phases_id',
        'blocking',
        'order',
        'due_date',
        'name',
        'som_status_id',
        'is_hidden'
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
        return SomProjectsMilestones::class;
    }
}
