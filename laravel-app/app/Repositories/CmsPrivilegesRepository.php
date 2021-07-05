<?php

namespace App\Repositories;

use App\Models\CmsPrivileges;
use App\Repositories\BaseRepository;

/**
 * Class CmsPrivilegesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:10 am UTC
*/

class CmsPrivilegesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'is_superadmin',
        'theme_color',
        'created_at',
        'updated_at',
        'is_app_role',
        'is_project_role'
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
        return CmsPrivileges::class;
    }
}
