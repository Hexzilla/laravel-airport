<?php

namespace App\Repositories;

use App\Models\CmsEmailTemplates;
use App\Repositories\BaseRepository;

/**
 * Class CmsEmailTemplatesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:15 am UTC
*/

class CmsEmailTemplatesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
        'subject',
        'content',
        'description',
        'from_name',
        'from_email',
        'cc_email',
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
        return CmsEmailTemplates::class;
    }
}
