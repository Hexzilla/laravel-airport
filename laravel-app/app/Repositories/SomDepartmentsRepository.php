<?php

namespace App\Repositories;

use App\Models\SomDepartments;
use App\Repositories\BaseRepository;

/**
 * Class SomDepartmentsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:23 am UTC
*/

class SomDepartmentsRepository extends BaseRepository
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
        return SomDepartments::class;
    }
}
