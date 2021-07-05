<?php

namespace App\Repositories;

use App\Models\CmsEmailQueues;
use App\Repositories\BaseRepository;

/**
 * Class CmsEmailQueuesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:16 am UTC
*/

class CmsEmailQueuesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'send_at',
        'email_recipient',
        'email_from_email',
        'email_from_name',
        'email_cc_email',
        'email_subject',
        'email_content',
        'email_attachments',
        'is_sent',
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
        return CmsEmailQueues::class;
    }
}
