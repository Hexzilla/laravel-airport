<?php

namespace App\Repositories;

use App\Models\CmsUsers;
use App\Repositories\BaseRepository;

/**
 * Class CmsUsersRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:17 am UTC
*/

class CmsUsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'photo',
        'email',
        'password',
        'id_cms_privileges',
        'created_at',
        'updated_at',
        'status',
        'job_title',
        'objectguid'
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
        return CmsUsers::class;
    }
}
