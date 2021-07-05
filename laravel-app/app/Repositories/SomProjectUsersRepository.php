<?php

namespace App\Repositories;

use App\Models\SomProjectUsers;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectUsersRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:35 am UTC
*/

class SomProjectUsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_projects_id',
        'cms_users_id',
        'cms_privileges_id'
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
        return SomProjectUsers::class;
    }
}
