<?php

namespace App\Repositories;

use App\Models\SomStatus;
use App\Repositories\BaseRepository;

/**
 * Class SomStatusRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:47 am UTC
*/

class SomStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hex_color',
        'name',
        'type',
        'icon',
        'display_text',
        'is_behaviour_completed',
        'is_behaviour_rejected',
        'is_behaviour_ongoing',
        'is_behaviour_review'
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
        return SomStatus::class;
    }
}
