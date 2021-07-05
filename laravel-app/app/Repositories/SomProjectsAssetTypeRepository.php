<?php

namespace App\Repositories;

use App\Models\SomProjectsAssetType;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsAssetTypeRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:41 am UTC
*/

class SomProjectsAssetTypeRepository extends BaseRepository
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
        return SomProjectsAssetType::class;
    }
}
