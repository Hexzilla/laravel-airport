<?php

namespace App\Repositories;

use App\Models\CmsStatisticComponents;
use App\Repositories\BaseRepository;

/**
 * Class CmsStatisticComponentsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:05 am UTC
*/

class CmsStatisticComponentsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_cms_statistics',
        'componentID',
        'component_name',
        'area_name',
        'sorting',
        'name',
        'config',
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
        return CmsStatisticComponents::class;
    }
}
