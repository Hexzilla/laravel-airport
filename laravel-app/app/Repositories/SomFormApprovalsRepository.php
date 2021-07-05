<?php

namespace App\Repositories;

use App\Models\SomFormApprovals;
use App\Repositories\BaseRepository;

/**
 * Class SomFormApprovalsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:25 am UTC
*/

class SomFormApprovalsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'som_forms_id',
        'order_approval'
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
        return SomFormApprovals::class;
    }
}
