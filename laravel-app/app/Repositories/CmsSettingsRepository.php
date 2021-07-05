<?php

namespace App\Repositories;

use App\Models\CmsSettings;
use App\Repositories\BaseRepository;

/**
 * Class CmsSettingsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:08 am UTC
*/

class CmsSettingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'content',
        'content_input_type',
        'dataenum',
        'helper',
        'created_at',
        'updated_at',
        'group_setting',
        'label'
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
        return CmsSettings::class;
    }
}
