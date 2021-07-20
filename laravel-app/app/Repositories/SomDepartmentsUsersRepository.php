<?php

namespace App\Repositories;

use App\Models\SomDepartmentsUsers;
use App\Repositories\BaseRepository;

/**
 * Class SomDepartmentsUsersRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:24 am UTC
*/

class SomDepartmentsUsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_departments_id',
        'cms_users_id'
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
        return SomDepartmentsUsers::class;
    }

    public function getAllData($som_departments_id){
        $select  = array();
        $select[0] = 'som_departments_users.*';
        $select[1] = 'som_departments.name as som_departments_name';
        $select[2] = 'cms_users.name as cms_users_name';
        $result = $this->makeModel()
            ->leftJoin('som_departments', 'som_departments_users.som_departments_id', 'som_departments.id')
            ->leftJoin('cms_users', 'som_departments_users.cms_users_id', 'cms_users.id')
            ->where('som_departments_users.som_departments_id', $som_departments_id)
            ->get($select);
        return $result;
    }

    public function getData($id){
        $select  = array();
        $select[0] = 'som_departments_users.*';
        $select[1] = 'som_departments.name as som_departments_name';
        $select[2] = 'cms_users.name as cms_users_name';
        $result = $this->makeModel()
            ->leftJoin('som_departments', 'som_departments_users.som_departments_id', 'som_departments.id')
            ->leftJoin('cms_users', 'som_departments_users.cms_users_id', 'cms_users.id')
            ->where('som_departments_users.id', $id)
            ->first($select);
        return $result;
    }

    public function getCountEqualData($som_departments_id, $cms_users_id){
        return $this->makeModel()
            ->where('som_departments_id', $som_departments_id)
            ->where('cms_users_id', $cms_users_id)
            ->count();
    }

    public function getCountEqualDataById($som_departments_id, $cms_users_id, $id){
        return $this->makeModel()
            ->where('som_departments_id', $som_departments_id)
            ->where('cms_users_id', $cms_users_id)
            ->where('id','<>', $id)
            ->count();
    }
}
