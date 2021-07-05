<?php

namespace App\Repositories;

use App\Models\SomDepartmentsUsers;
use App\Repositories\BaseRepository;

/**
 * Class SomDepartmentsUsersRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:24 am UTC
*/

class SomDepartmentsUsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_departments_id',
        'cms_users_id'
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
        return SomDepartmentsUsers::class;
    }
}
