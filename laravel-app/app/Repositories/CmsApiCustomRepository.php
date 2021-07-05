<?php

namespace App\Repositories;

use App\Models\CmsApiCustom;
use App\Repositories\BaseRepository;

/**
 * Class CmsApiCustomRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:01 am UTC
*/

class CmsApiCustomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'permalink',
        'tabel',
        'aksi',
        'kolom',
        'orderby',
        'sub_query_1',
        'sql_where',
        'nama',
        'keterangan',
        'parameter',
        'created_at',
        'updated_at',
        'method_type',
        'parameters',
        'responses'
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
        return CmsApiCustom::class;
    }
}
