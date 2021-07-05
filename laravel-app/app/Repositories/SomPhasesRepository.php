<?php

namespace App\Repositories;

use App\Models\SomPhases;
use App\Repositories\BaseRepository;

/**
 * Class SomPhasesRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:31 am UTC
*/

class SomPhasesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'hex_color',
        'is_visible'
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
        return SomPhases::class;
    }
}
