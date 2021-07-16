<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiGetProjectController extends Controller
{
    public function index(Request $request){
        $project_id = $request->get('id');
        $user_id = Auth::id();

        $resultRQ = array();
        $resultRQ['api_http']=500;
        $resultRQ['api_status'] = "KO";
        $resultRQ['api_message'] = "Project not found!";
        $color_project_not_initialized="#FFFFFF";
        $result = array();

        if($user_id == null){
            $resultRQ['api_http'] = 401;
            $resultRQ['api_message'] = "Unauthorized Operation";
            $result= $resultRQ;
        } else {
            $resultRQ['api_http'] = 200;
            $project = DB::table('som_project_users')
                ->where([['cms_users_id', $user_id],['som_projects_id',$project_id]])
                ->first();
            $root_folder = env('SHAREPOINT_LINK_URL').env('SHAREPOINT_ROOT_FOLDER');
            if($project){
                $result['project'] = DB::table('som_projects')
                    ->leftJoin('som_projects_asset_type', 'som_projects.som_projects_asset_type_id', '=', 'som_projects_asset_type.id')
                    ->leftJoin('som_project_info_status', 'som_project_info_status.id', '=', 'som_projects.som_project_info_status_id')
                    ->leftJoin('som_status', 'som_status.id', '=', 'som_projects.som_status_id')
                    ->leftJoin('som_project_process_type', 'som_project_process_type.id', '=', 'som_project_process_type_id')
                    ->leftJoin('som_projects_model', 'som_projects_model.id', '=', 'som_projects_model_id')
                    ->leftJoin('som_projects_priority', 'som_projects_priority.id', '=', 'som_project_priority_id')
                    ->leftJoin('som_projects_airport', 'som_projects_airport.id', '=', 'som_projects_airport_id')
                    ->where('som_projects.id',$project_id)
                    ->select(
                        'som_project_info_status.name AS som_project_status_name',
                        'som_projects.id AS som_projects_id',
                        'som_projects.img_url AS som_projects_img_url',
                        'som_projects.name AS som_projects_name',
                        'som_projects_airport.address AS som_projects_street',
                        'som_projects_airport.country AS som_projects_country',
                        'som_projects_airport.city AS som_projects_city',
                        'som_projects_airport.size AS som_projects_airport_size',
                        'som_projects.sub_name AS som_projects_sub_name',
                        'som_projects_airport.lat AS som_projects_lat',
                        'som_projects_airport.long AS som_projects_long',

                        DB::raw('concat("'.$root_folder.'",som_projects.documentation_folder) AS som_projects_documentation_folder'),
                        'som_projects.grantor AS som_projects_grantor',
                        'som_projects_asset_type.name AS som_projects_asset_type',
                        'som_projects_model.name AS som_projects_transaction_type',
                        'som_project_process_type.name AS som_projects_process_type',
                        'som_projects.equity AS som_projects_equity',
                        'som_projects.pr_length AS som_projects_pr_length',
                        'som_projects.timeoffset AS som_projects_timeoffset',
                        'som_projects.concession_date_start AS som_projects_concession_date_start',
                        'som_projects.bid_presentation_date AS som_projects_bid_presentation_date',
                        'som_projects.ev AS som_projects_ev',
                        'som_projects.duration AS som_projects_duration',
                        'som_projects.responsibility AS som_projects_responsibility',
                        'som_projects.valuation AS som_projects_valuation',
                        'som_projects.solvency AS som_projects_solvency',
                        'som_projects.deal_rational AS som_projects_deal_rational',
                        'som_projects.contract_scope AS som_projects_contract_scope',
                        'som_projects.other_requirements AS som_projects_other_requeriments',
                        'som_projects.percentage_participation AS som_projects_percentage_participation',

                        DB::raw('IFNULL(som_status.hex_color, \''.$color_project_not_initialized.'\') AS som_status_hex_color'),
                        DB::raw('IFNULL(som_status.name, \'not_initiated\') AS som_status_name'),
                        DB::raw('IFNULL(som_status.is_behaviour_completed, 0) AS som_status_is_behaviour_completed'),
                        DB::raw('IFNULL(som_status.is_behaviour_ongoing, 0) AS som_status_is_behaviour_ongoing')
                    )->first();


                $result['project']->airport = DB::table('som_projects')
                    ->leftJoin('som_projects_airport', 'som_projects_airport.id', '=', 'som_projects_airport_id')
                    ->leftJoin('som_projects_airport_type', 'som_projects_airport_type.id', '=', 'som_projects_airport.som_projects_airport_type_id')
                    ->leftJoin('som_country', 'som_country.id', '=', 'som_projects_airport.som_country_id')
                    ->where('som_projects.id',$project_id)
                    ->select(
                        'som_projects_airport.name AS name',
                        'som_projects_airport.address AS address',
                        'som_projects_airport.City AS city',
                        'som_country.country AS country',
                        'som_projects_airport.iata_oaci AS iata_oaci',
                        'som_projects_airport_type.name AS airport_type',
                        'som_projects_airport.size AS size',
                        'som_projects_airport.revenues_aeronautical AS revenues_aeronautical',
                        'som_projects_airport.revenues_non_aeronautical AS revenues_non_aeronautical',
                        'som_projects_airport.total_revenues AS total_revenues',
                        'som_projects_airport.total_opex AS total_opex',
                        'som_projects_airport.ebitda AS EBITDA',
                        'som_projects_airport.kpi_revenues_aeronautical AS kpi_revenues_aeronautical',
                        'som_projects_airport.kpi_revenues_non_aeronautical AS kpi_revenues_non_aeronautical',
                        'som_projects_airport.kpi_ebitda AS kpi_ebitda',
                        'som_projects_airport.debt_ebitda AS debt_ebitda',
                        'som_projects_airport.percentage_international AS percentage_international',
                        'som_projects_airport.percentage_transfer AS percentage_transfer',
                        'som_projects_airport.percentage_non_low_cost AS percentage_non_low_cost',
                        'som_projects_airport.infrastructure_characterization_description AS infrastructure_characterization_description',
                        'som_projects_airport.airport_catchment_area AS airport_catchment_area',
                        'som_projects_airport.competitors AS competitors',
                        'som_projects_airport.top1_airline AS top1_airline',
                        'som_projects_airport.top2_airline AS top2_airline',
                        'som_projects_airport.top3_airline AS top3_airline',
                        'som_projects_airport.top1_airline_percentage AS top1_airline_percentage',
                        'som_projects_airport.top2_airline_percentage AS top2_airline_percentage',
                        'som_projects_airport.top3_airline_percentage AS top3_airline_percentage',
                        'som_projects_airport.route AS route',
                        'som_projects_airport.master_plan_estimations AS master_plan_estimations',
                        'som_projects_airport.society_model_regulation AS society_model_regulation',
                        'som_projects_airport.aena_network_improvement AS aena_network_improvement',
                        'som_projects_airport.img_url AS som_projects_airport_img_url',
                        'som_projects_airport.other_info AS som_projects_airport_other_info',
                        'som_projects_airport.data_year AS som_projects_airport_data_year',
                        'som_projects_airport.version_date AS som_projects_airport_version_date'

                    )
                    ->first();

                //PROJECT COUNTRY
                $result['project']->country = DB::table('som_projects')
                    ->leftJoin('som_country', 'som_projects.som_country_id', '=', 'som_country.id')
                    ->select(
                        'som_country.country AS country',
                        'som_country.country_code AS country_code',
                        'som_country.description AS description',
                        'som_country.politics AS politics',
                        'som_country.regulatory AS regulatory',
                        'som_country.corruption AS corruption',
                        'som_country.business_easyness AS business_easyness',
                        'som_country.spain_affinity AS spain_affinity',
                        'som_country.aena_strategy_align AS aena_strategy_align',
                        'som_country.tourism_activity AS tourism_activity',
                        'som_country.country_risk AS country_risk',
                        'som_country.imports_exports AS imports_exports',
                        'som_country.version_date AS version_date',
                        'som_country.exchange_rate AS exchange_rate'
                    )
                    ->where('som_projects.id',$project_id)
                    ->distinct()
                    ->first();

                $result['project']->country->additional_info = array();
                $result['project']->country->additional_info = DB::table('som_projects')
                    ->join('som_country', 'som_projects.som_country_id', '=', 'som_country.id')
                    ->leftJoin('som_country_info', 'som_country.id', '=', 'som_country_info.som_country_id')
                    ->where('som_projects.id',$project_id)
                    ->orderBy('som_country_info.year')
                    ->select(
                        'som_country_info.year AS year',
                        'som_country_info.inflation AS inflation',
                        'som_country_info.population AS population',
                        'som_country_info.gpd_evolution AS gpd_evolution'
                    )
                    ->get();

                //PROJECT USERS
//                $result['project']->project_due_date;
                $result['project']->users = array();
                $result['project']->users = DB::table('som_project_users')
                    ->join('cms_users', 'som_project_users.cms_users_id', '=', 'cms_users.id')
                    ->join('cms_privileges', 'som_project_users.cms_privileges_id', '=', 'cms_privileges.id')
                    ->where('som_project_users.som_projects_id',$project_id)
                    ->select(
                        'cms_users.id AS cms_users_id',
                        'cms_users.name AS cms_users_name',
                        'cms_users.email AS cms_users_email',
                        'cms_users.photo AS cms_users_photo',
                        'cms_users.job_title AS cms_users_job_title'
                    //'cms_privileges.name AS cms_privileges_name',
                    //'cms_privileges.id AS cms_privileges_id'
                    )
                    ->distinct()
                    ->get();

                //PROJECT PHASES
                $result['project']->phases = array();
                $result['project']->phases = DB::table('som_projects_phases')
                    ->join('som_phases', 'som_projects_phases.som_phases_id', '=', 'som_phases.id')
                    ->leftJoin('som_status', 'som_status.id', '=', 'som_projects_phases.som_status_id')
                    ->where('som_projects_phases.som_projects_id',$project_id)
                    ->orderBy('som_projects_phases.order', 'asc')
                    ->select(
                        'som_phases.id AS som_phases_id',
                        'som_phases.name AS som_phases_name',
                        'som_phases.hex_color AS som_phases_hex_color',
                        'som_projects_phases.id AS som_projects_phases_id',
                        'som_projects_phases.order AS som_projects_phases_order',
                        // 'som_projects_phases.is_inactive AS is_inactive',
                        DB::raw('IFNULL(som_status.hex_color, \''.$color_project_not_initialized.'\') AS som_status_hex_color'),
                        DB::raw('IFNULL(som_status.name, \'not_initiated\') AS som_status_name'),
                        DB::raw('IFNULL(som_status.is_behaviour_completed, 0) AS som_status_is_behaviour_completed'),
                        DB::raw('IFNULL(som_status.is_behaviour_ongoing, 0) AS som_status_is_behaviour_ongoing')
                    )
                    ->get();
                //MULTI AIRPORT
                $result['project']->multi_airport = array();
                array_push($result['project']->multi_airport, $result['project']->airport);

                $multi_airport = DB::table('som_projects_airport')
                    ->join('som_projects_additional_airport', 'som_projects_additional_airport.som_airport_id', '=', 'som_projects_airport.id')
                    ->join('som_projects_airport_type', 'som_projects_airport_type.id', '=', 'som_projects_airport.som_projects_airport_type_id')
                    ->leftJoin('som_country', 'som_country.id', '=', 'som_projects_airport.som_country_id')
                    ->where('som_projects_additional_airport.som_project_id',$project_id)
                    ->select(
                        'som_projects_airport.name AS name',
                        'som_projects_airport.address AS address',
                        'som_projects_airport.City AS city',
                        'som_country.country AS country',
                        'som_projects_airport.iata_oaci AS iata_oaci',
                        'som_projects_airport_type.name AS airport_type',
                        'som_projects_airport.size AS size',
                        'som_projects_airport.revenues_aeronautical AS revenues_aeronautical',
                        'som_projects_airport.revenues_non_aeronautical AS revenues_non_aeronautical',
                        'som_projects_airport.total_revenues AS total_revenues',
                        'som_projects_airport.total_opex AS total_opex',
                        'som_projects_airport.ebitda AS EBITDA',
                        'som_projects_airport.kpi_revenues_aeronautical AS kpi_revenues_aeronautical',
                        'som_projects_airport.kpi_revenues_non_aeronautical AS kpi_revenues_non_aeronautical',
                        'som_projects_airport.kpi_ebitda AS kpi_ebitda',
                        'som_projects_airport.debt_ebitda AS debt_ebitda',
                        'som_projects_airport.percentage_international AS percentage_international',
                        'som_projects_airport.percentage_transfer AS percentage_transfer',
                        'som_projects_airport.percentage_non_low_cost AS percentage_non_low_cost',
                        'som_projects_airport.infrastructure_characterization_description AS infrastructure_characterization_description',
                        'som_projects_airport.airport_catchment_area AS airport_catchment_area',
                        'som_projects_airport.competitors AS competitors',
                        'som_projects_airport.top1_airline AS top1_airline',
                        'som_projects_airport.top2_airline AS top2_airline',
                        'som_projects_airport.top3_airline AS top3_airline',
                        'som_projects_airport.top1_airline_percentage AS top1_airline_percentage',
                        'som_projects_airport.top2_airline_percentage AS top2_airline_percentage',
                        'som_projects_airport.top3_airline_percentage AS top3_airline_percentage',
                        'som_projects_airport.route AS route',
                        'som_projects_airport.master_plan_estimations AS master_plan_estimations',
                        'som_projects_airport.society_model_regulation AS society_model_regulation',
                        'som_projects_airport.aena_network_improvement AS aena_network_improvement',
                        'som_projects_airport.img_url AS som_projects_airport_img_url')->get();

                foreach ($multi_airport as &$m_airport) {
                    array_push($result['project']->multi_airport, $m_airport);
                }

                //PHASES MILESTONES
                foreach ($result['project']->phases as &$phase) {
                    $phase->formscount = 0;
                    $phase->formscompletedcount = 0;
                    $phase->formsongoingcount = 0;
                    $phase->milestones = array();
                    $phase->milestones = DB::table('som_phases_milestones')
                        ->leftJoin('som_status', 'som_status.id', '=', 'som_phases_milestones.som_status_id')
                        ->where('som_projects_phases_id', $phase->som_projects_phases_id)
                        ->orderBy('som_phases_milestones.order', 'asc')
                        ->select(
                            'som_phases_milestones.id AS som_phases_milestones_id',
                            'blocking AS som_phases_milestones_blocking',
                            'order AS som_phases_milestones_order',
                            'due_date AS som_phases_milestones_due_date',
                            'is_hidden AS som_phases_milestones_is_hidden',
                            'som_phases_milestones.name AS som_phases_milestones_name',
                            DB::raw('IFNULL(som_status.hex_color, \''.$color_project_not_initialized.'\') AS som_status_hex_color'),
                            DB::raw('IFNULL(som_status.name, \'not_initiated\') AS som_status_name'),
                            DB::raw('IFNULL(som_status.is_behaviour_completed, 0) AS som_status_is_behaviour_completed'),
                            DB::raw('IFNULL(som_status.is_behaviour_ongoing, 0) AS som_status_is_behaviour_ongoing')
                        )
                        ->get();

                    foreach ($phase->milestones as &$milestone){

                        if (!isset($result['project']->project_due_date) || $milestone->som_phases_milestones_due_date > $result['project']->project_due_date){
                            $result['project']->project_due_date = $milestone->som_phases_milestones_due_date;
                        }

                        $milestone->form = array();
                        $milestone->form =  DB::table('som_forms')
                            ->join('som_milestones_forms_types', 'som_milestones_forms_types.id', '=', 'som_forms.som_milestones_forms_types_id')
                            ->leftJoin('som_status', 'som_status.id', '=', 'som_forms.som_status_id')
                            ->where('som_forms.som_phases_milestones_id', $milestone->som_phases_milestones_id)
                            ->select(
                                'som_forms.id AS som_forms_id',
                                'som_forms.name AS som_forms_name',
                                'som_forms.active AS som_forms_active',
                                'som_forms.is_inactive AS is_inactive',
                                'som_forms.order_form AS som_forms_order_form',
                                'som_milestones_forms_types.name AS som_milestones_forms_types_name',
                                'som_milestones_forms_types.id AS som_milestones_forms_types_id',
                                DB::raw('IFNULL(som_status.hex_color, \''.$color_project_not_initialized.'\') AS som_status_hex_color'),
                                DB::raw('IFNULL(som_status.name, \'not_initiated\') AS som_status_name'),
                                DB::raw('IFNULL(som_status.is_behaviour_completed, 0) AS som_status_is_behaviour_completed'),
                                DB::raw('IFNULL(som_status.is_behaviour_ongoing, 0) AS som_status_is_behaviour_ongoing')
                            )->get();

                        foreach ($milestone->form as &$f){

                            $is_legal_or_finance = DB::table('som_forms')
                                ->join('som_form_tasks', 'som_forms.id', '=', 'som_form_tasks.som_forms_id')
                                ->join('som_departments', 'som_departments.id', '=', 'som_form_tasks.som_departments_id')
                                ->join('som_departments_users', 'som_departments_users.som_departments_id', '=', 'som_departments.id')
                                ->where('som_forms.id',$f->som_forms_id)
                                ->whereIn('som_departments.name',['Finance','Legal'])
                                ->where('som_departments_users.cms_users_id',$user_id)
                                ->select('som_departments.name AS department_related')
                                ->distinct()
                                ->get();

                            $f->is_legal_finance = 0;

                            if (count($is_legal_or_finance)>0) {
                                $f->is_legal_finance = 1;
                                $f->user_department_related = "";
                                foreach ($is_legal_or_finance as &$lof){
                                    if ($f->user_department_related != ""){
                                        $f->user_department_related .= " y ";
                                    }
                                    $f->user_department_related .= $lof->department_related;
                                }
                            }

                            if ($f->som_status_is_behaviour_completed==1){
                                $phase->formscompletedcount +=1;
                            }
                            if ($f->som_status_is_behaviour_ongoing==1){
                                $phase->formsongoingcount +=1;
                            }
                        }
                        $phase->formscount += count($milestone->form);
                    }

                }
                if(isset($result['project']->som_projects_pr_length)){
                    $start_date = strtotime ( '-'.$result['project']->som_projects_pr_length.' month' , strtotime ( $result['project']->project_due_date ) ) ;
                    $result['project']->project_start_date = date ( 'Y-m-j' , $start_date );
                }

                //PROJECT PARTNERS
                $result['project']->partners = array();
                $result['project']->partners = DB::table('som_projects_partners')
                    ->where('som_projects_partners.som_projects_id',$project_id)
                    ->get();

                //PROJECT ADVISORS
                $result['project']->advisors = array();
                $result['project']->advisors = DB::table('som_projects_advisors')
                    ->where('som_projects_advisors.som_projects_id',$project_id)
                    ->get();

                $resultRQ['api_status'] = "OK";
                $resultRQ['api_message'] = "";
                $resultRQ['data'] = $result;
            }
            $result = $resultRQ;
        }
        return json_encode($result);
    }
}
