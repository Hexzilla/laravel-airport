<?php

namespace App\Repositories;

use App\Models\SomProjects;
use App\Repositories\BaseRepository;

/**
 * Class SomProjectsRepository
 * @package App\Repositories
 * @version July 5, 2021, 9:36 am UTC
*/

class SomProjectsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'sub_name',
        'grantor',
        'concession_date_start',
        'bid_presentation_date',
        'equity',
        'pr_length',
        'is_template_project',
        'timeoffset',
        'is_awarded',
        'is_dismissed',
        'contract_scope',
        'deal_rational',
        'other_requirements',
        'valuation',
        'solvency',
        'documentation_folder',
        'som_status_id',
        'som_project_process_type_id',
        'som_project_priority_id',
        'som_project_info_status_id',
        'som_projects_model_id',
        'som_projects_asset_type_id',
        'som_projects_airport_id',
        'som_country_id',
        'percentage_participation',
        'ev',
        'duration',
        'responsibility',
        'email_legal',
        'email_finance',
        'img_url'
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
        return SomProjects::class;
    }  

    public function getAllData(){
        $select  = array();
        $select[0] = 'som_projects.*';
        $select[1] = 'som_projects_model.name as som_project_model_name';
        $select[2] = 'som_project_process_type.name as som_project_process_type_name';
        $select[3] = 'som_country.country as som_country_name';
        $select[4] = 'som_project_info_status.name as som_project_info_status_name';
        $result = $this->makeModel()
            ->leftJoin('som_projects_model', 'som_projects.som_projects_model_id', 'som_projects_model.id')
            ->leftJoin('som_project_process_type','som_projects.som_project_process_type_id','som_project_process_type.id')
            ->leftJoin('som_country','som_projects.som_country_id','som_country.id')
            ->leftJoin('som_project_info_status','som_projects.som_project_info_status_id','som_project_info_status.id')
            ->get($select);
        return $result;
    } 

    public function getCountByAirportId($airport_id){
        return $this->makeModel()
            ->where('som_projects_airport_id', $airport_id)
            ->count();
    } 

    public function getCountByCountryId($country_id){
        return $this->makeModel()
            ->where('som_country_id', $country_id)
            ->count();
    } 
}
