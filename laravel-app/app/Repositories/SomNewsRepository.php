<?php

namespace App\Repositories;

use App\Models\SomNews;
use App\Repositories\BaseRepository;

/**
 * Class SomNewsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:30 am UTC
*/

class SomNewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'news_description',
        'date_from',
        'date_until'
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
        return SomNews::class;
    }
}
