<?php

namespace App\Repositories;

use App\Models\CmsMenus;
use App\Repositories\BaseRepository;

/**
 * Class CmsMenusRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:14 am UTC
*/

class CmsMenusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'path',
        'color',
        'icon',
        'parent_id',
        'is_active',
        'is_dashboard',
        'id_cms_privileges',
        'sorting',
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
        return CmsMenus::class;
    }
}
