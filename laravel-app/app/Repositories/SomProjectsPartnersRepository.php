<?php

namespace App\Repositories;

use App\Models\SomProjectsPartners;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsPartnersRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:43 am UTC
*/

class SomProjectsPartnersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'som_projects_id',
        'company',
        'company_profile',
        'role_in_project',
        'email',
        'phone_number',
        'other_information'
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
        return SomProjectsPartners::class;
    }
}
