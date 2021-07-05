<?php

namespace App\Repositories;

use App\Models\SomFormElements;
use App\Repositories\BaseRepository;

/**
 * Class SomFormElementsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:26 am UTC
*/

class SomFormElementsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'document',
        'doc_url_description',
        'template',
        'template_url_description',
        'lastupdate',
        'comment',
        'som_forms_id',
        'order_elements',
        'is_mandatory',
        'is_sub_element',
        'tooltip',
        'cms_privileges_role_id'
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
        return SomFormElements::class;
    }
}
