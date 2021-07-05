<?php

namespace App\Repositories;

use App\Models\CmsPrivilegesRoles;
use App\Repositories\BaseRepository;

/**
 * Class CmsPrivilegesRolesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:09 am UTC
*/

class CmsPrivilegesRolesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'is_visible',
        'is_create',
        'is_read',
        'is_edit',
        'is_delete',
        'id_cms_privileges',
        'id_cms_moduls',
        'created_at',
        'updated_at'
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
        return CmsPrivilegesRoles::class;
    }
}
