<?php

namespace App\Repositories;

use App\Models\CmsDashboard;
use App\Repositories\BaseRepository;

/**
 * Class CmsDashboardRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:17 am UTC
*/

class CmsDashboardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'id_cms_privileges',
        'content',
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
        return CmsDashboard::class;
    }
}
