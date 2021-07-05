<?php

namespace App\Repositories;

use App\Models\SomForms;
use App\Repositories\BaseRepository;

/**
 * Class SomFormsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:28 am UTC
*/

class SomFormsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'active',
        'som_phases_milestones_id',
        'order_form',
        'som_milestones_forms_types_id',
        'som_status_id',
        'is_inactive'
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
        return SomForms::class;
    }
}
