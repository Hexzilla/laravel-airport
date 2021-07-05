<?php

namespace App\Repositories;

use App\Models\CmsApiKey;
use App\Repositories\BaseRepository;

/**
 * Class CmsApiKeyRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:03 am UTC
*/

class CmsApiKeyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'screetkey',
        'hit',
        'status',
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
        return CmsApiKey::class;
    }
}
