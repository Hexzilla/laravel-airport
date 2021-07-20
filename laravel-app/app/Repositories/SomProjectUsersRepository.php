<?php

namespace App\Repositories;

use App\Models\SomProjectUsers;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectUsersRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:35 am UTC
*/

class SomProjectUsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'som_projects_id',
        'cms_users_id',
        'cms_privileges_id'
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
        return SomProjectUsers::class;
    }

    public function getDataBySomProjectsId($som_projects_id){
        $select  = array();
        $select[0] = 'som_project_users.*';
        $select[1] = 'cms_users.name as cms_users_name';
        $select[2] = 'cms_privileges.name as cms_privileges_name';
        $result = $this->makeModel()
            ->leftJoin('cms_users', 'som_project_users.cms_users_id', 'cms_users.id')
            ->leftJoin('cms_privileges', 'som_project_users.cms_privileges_id', 'cms_privileges.id')
            ->where('som_project_users.som_projects_id', $som_projects_id)
            ->get($select);
        return $result;
    }

    public function getData($id){
        $select  = array();
        $select[0] = 'som_project_users.*';
        $select[1] = 'cms_users.name as cms_users_name';
        $select[2] = 'cms_privileges.name as cms_privileges_name';
        $result = $this->makeModel()
            ->leftJoin('cms_users', 'som_project_users.cms_users_id', 'cms_users.id')
            ->leftJoin('cms_privileges', 'som_project_users.cms_privileges_id', 'cms_privileges.id')
            ->where('som_project_users.id', $id)
            ->first($select);
        return $result;
    }
}
