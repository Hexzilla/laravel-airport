<?php

namespace App\Repositories;

use App\Models\SomStatusApprovals;
use App\Repositories\BaseRepository;

/**
 * Class SomStatusApprovalsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:48 am UTC
*/

class SomStatusApprovalsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_status_id',
        'som_approvals_responsible_id',
        'status_order'
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
        return SomStatusApprovals::class;
    }
}
