<?php

namespace App\Repositories;

use App\Models\CmsLogs;
use App\Repositories\BaseRepository;

/**
 * Class CmsLogsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:04 am UTC
*/

class CmsLogsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipaddress',
        'useragent',
        'url',
        'description',
        'details',
        'id_cms_users',
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
        return CmsLogs::class;
    }
}
