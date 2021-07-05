<?php

namespace App\Repositories;

use App\Models\CmsStatistics;
use App\Repositories\BaseRepository;

/**
 * Class CmsStatisticsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:06 am UTC
*/

class CmsStatisticsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
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
        return CmsStatistics::class;
    }
}
