<?php

namespace App\Repositories;

use App\Models\CmsMenusPrivileges;
use App\Repositories\BaseRepository;

/**
 * Class CmsMenusPrivilegesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:13 am UTC
*/

class CmsMenusPrivilegesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_cms_menus',
        'id_cms_privileges'
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
        return CmsMenusPrivileges::class;
    }
}
