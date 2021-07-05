<?php

namespace App\Repositories;

use App\Models\CmsModuls;
use App\Repositories\BaseRepository;

/**
 * Class CmsModulsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:12 am UTC
*/

class CmsModulsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon',
        'path',
        'table_name',
        'controller',
        'is_protected',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at'
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
        return CmsModuls::class;
    }
}
