<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as Request1;
use App\Http\Utils\CRUDBooster;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::id();
        if($user_id==''){
            $urlactual =\URL::full();
            return redirect(CRUDBooster::adminPath()."/loginhome?return_url=".urlencode($urlactual));
        }

        //TODO: Figure out where we are using this and why they are null
        $project_id = $request->get('project_id');
        $show_phases = $request->get('show_phases');

        //echo $project_id;
        //echo $show_phases;

        $viewData['username']= Auth::user()->name;
        $viewData['userphoto']= Auth::user()->photo;

        $currency = (CRUDBooster::getSetting('currency')?(CRUDBooster::getSetting('currency')):'M $');
        $viewData['currency'] = $currency;

        $queryPhases="SELECT ph.id, ph.name, ph.hex_color FROM som_projects p
                        join som_projects_phases pp on p.id=pp.som_projects_id
                        join som_phases ph on ph.id=pp.som_phases_id
                        WHERE is_template_project=1 order by `order` ";
        $phasesList = DB::select(DB::raw($queryPhases));
        $viewData['phases_list']=$phasesList;

        $queryProjectStatus = "SELECT id, name FROM som_project_info_status ORDER BY id";
        $projectInfoStatusList = DB::select(DB::raw($queryProjectStatus));
        $viewData['proj_status_info']=$projectInfoStatusList;

        //Nuevo filtro aena para tamaño airport
        $viewData['airport_size_list']=array(
            ["name"=>"<2M","min"=>'0.00',"max"=>'1.99'],
            ["name"=>"2-10M","min"=>'2.00',"max"=>'10.00'],
            ["name"=>">10M","min"=>'10.01',"max"=>9999999]);

        //Pasamos los parametros en un array para evitar SqlInjection
        $queryProjModel="select id, name,concat('images/icons/',concat(concat('airport_',name),'.png')) as image  from som_projects_model";
        $projModelList = DB::select(DB::raw($queryProjModel));
        $viewData['proj_model_list']=$projModelList;

        $color_project_not_initialized="#cc0000";
        $projectMapMarks = DB::table('som_projects')
            ->join('som_project_users', 'som_projects.id', '=', 'som_project_users.som_projects_id')
            ->leftJoin('som_status', 'som_projects.som_status_id', '=', 'som_status.id')
            ->leftJoin('som_project_info_status', 'som_projects.som_project_info_status_id', '=', 'som_project_info_status.id')
            ->Join('som_projects_airport', 'som_projects.som_projects_airport_id', '=', 'som_projects_airport.id')
            ->Join('som_projects_model', 'som_projects.som_projects_model_id', '=', 'som_projects_model.id')
            ->leftJoin('som_country', 'som_projects.som_country_id', '=', 'som_country.id')
            ->where([
                ['som_project_users.cms_users_id','=',$user_id],
                ['som_projects.is_template_project','=',0]])
            ->select(
                'som_projects.timeoffset AS timeoffset',
                'som_projects.id AS id',
                'som_projects.img_url AS image',
                'som_projects.som_projects_model_id AS som_projects_model_id',
                'som_projects.name',
                'som_country.country AS country',
                'som_projects_airport.City AS city',
                'som_projects.name AS project',
                'som_projects_airport.size AS som_projects_airport_size',
                /*'som_projects.is_awarded AS som_projects_is_awarded',*/
                /*'som_projects.is_dismissed AS som_projects_is_dismissed',*/
                'som_projects.som_project_info_status_id',
                DB::raw('CONCAT(\'images/icons/airport_\',som_projects_model.name,\'.png\') AS project_icon'),
                DB::raw('IFNULL(som_projects_airport.lat, 0) AS lat'),
                DB::raw('IFNULL(som_projects_airport.long, 0) AS lng'),
                //DB::raw('IFNULL(som_status.hex_color, \''.$color_project_not_initialized.'\') AS project_status_color'),
                DB::raw("IFNULL(
                                (SELECT hex_color from som_phases
                                    where som_phases.id =
                                        (SELECT som_projects_phases.som_phases_id
                                            FROM som_projects_phases
                                            WHERE som_projects_id = som_projects.id
                                            AND som_status_id IS NOT NULL
                                            AND som_projects_phases.order =
                                                (SELECT MAX(som_projects_phases.order) last
                                                    FROM som_projects_phases
                                                    WHERE som_projects_id = som_projects.id
                                                    AND som_status_id IS NOT NULL
                                                )
                                        )
                                ),'".$color_project_not_initialized."') AS project_status_color"),
                DB::raw('(CASE som_status.is_behaviour_completed WHEN 1 THEN 1 ELSE 0 END) AS is_closed'))
            ->distinct()->get();

        if($projectMapMarks == null){
            SomLogger::debug("DBG1001",'No encontramos proyectos');
            $projectMapMarks="";
        }
        $viewData['project_map_marks']=json_encode($projectMapMarks);

        //2) Calculo del listado de proyectos
        $queryProjList = "select distinct p.id as id,
            p.img_url as image, #Imagen
            p.name, #Nombre del proyecto
            c.country, #Pais
            pis.name as pr_status,
            p.equity, #
            IFNULL((SELECT ph.name
                FROM som_projects_phases
                inner join som_phases ph on ph.id=som_projects_phases.som_phases_id
                WHERE som_projects_id = p.id
                AND som_status_id IS NOT NULL
                AND som_projects_phases.order = (SELECT MAX(som_projects_phases.order) last
                        FROM som_projects_phases
                        WHERE som_projects_id = p.id
                        AND som_status_id IS NOT NULL
                    ) limit 1), 'Not initiated') as phase, #etapa

            IFNULL((select mil.name
                from som_phases_milestones mil
                inner join som_projects_phases prh on prh.id=mil.som_projects_phases_id
                where som_projects_id = p.id
                AND mil.som_status_id IS NOT NULL
                AND mil.order = (
                            SELECT MAX(mil2.order) last
                            FROM som_phases_milestones mil2
                            inner join som_projects_phases prh2 on prh2.id = mil2.som_projects_phases_id
                            WHERE som_projects_id = p.id
                            AND mil2.som_status_id IS NOT NULL
                )
                    limit 1), '') as subphase, #subetapa
            m.name as transaction_type,
            pa.size as size,#Tamaño
            p.valuation as Valuation,
            at.name AS asset_type,
            prt.name as process_type,
            p.grantor as grantor,
            p.contract_scope as contract_scope,
            p.percentage_participation as participation_percentage,
            p.duration as duration,
            pat.name as airport_type,
            pa.revenues_aeronautical as Revenues_aeronautical,
            pa.revenues_non_aeronautical as Revenues_non_aeronautical,
            pa.total_revenues as total_revenues,
            pa.total_opex as total_opex,
            pa.ebitda as EBITDA,
            pa.kpi_revenues_aeronautical as Revenues_aeronautical_pax,
            pa.kpi_revenues_non_aeronautical as Revenues_non_aeronautical_pax,
            pa.kpi_ebitda as EBITDA_pax,
            pa.debt_ebitda as Debt_Ebitda,
            pa.city AS city
            from som_projects p
            inner join som_country c on p.som_country_id=c.id
            inner join som_projects_model m on p.som_projects_model_id=m.id
            inner join som_project_users pu on p.id = pu.som_projects_id
            left join som_projects_asset_type at on at.id=p.som_projects_asset_type_id
            inner join som_projects_airport pa on p.som_projects_airport_id=pa.id
            left join som_projects_airport_type pat on pa.som_projects_airport_type_id=pat.id
            left join som_project_process_type prt on prt.id = p.som_project_process_type_id
            left join som_project_info_status pis on pis.id = p.som_project_info_status_id
            where pu.cms_users_id = :user_id
            and p.is_template_project = 0";

        //Pasamos los parametros en un array para evitar SqlInjection
        $projectList = DB::select(DB::raw($queryProjList), array('user_id'=>$user_id));
        //Log::debug('Listado proyectos:'.json_encode($projectList));

        $arrProjList= array();
        //Componemos info para DataTable con el listado de Proyectos
        foreach ($projectList as &$row) {
            $arrProjList[] = array("<img src='".$row->image."'class='project_list_image' onerror=\"this.onerror=null;this.src='images/icons/default_project_img.png';\">",
                $row->name, //Nombre del proyecto
                $row->country, //País
                $row->pr_status,//Estado
                $row->phase,  //Etapa
                $row->subphase,  //Subetapa
                $row->transaction_type, //Tipo de transacción
                $row->size, //Tamaño (Mpax)
                $row->Valuation,//Valoración (M€)
                $row->asset_type,//Tipo de activo
                $row->process_type, //Tipo de proceso
                $row->grantor,//Concedente
                $row->contract_scope,//Alcance del contrato
                $row->participation_percentage,//% participación
                $row->duration,//Duración de la concesión
                $row->airport_type,//Tipo de aeropuerto
                $row->Revenues_aeronautical,//Ingresos aeronáuticos (€ mn)
                $row->Revenues_non_aeronautical,//Ingresos no aeronáuticos (€ mn)
                $row->total_revenues,//Total ingresos (€ mn)
                $row->total_opex,//Total opex (€ mn)
                $row->EBITDA,//EBITDA (€ mn)
                $row->Revenues_aeronautical_pax,//Ingresos aeronáuticos / pax
                $row->Revenues_non_aeronautical_pax,//Ingresos no aeronáuticos / pax
                $row->EBITDA_pax,//EBITDA / pax
                $row->Debt_Ebitda,//Deuda / EBITDA
                "<button class='btn btn-dark downloadButton' style='background:#1a2732;' onclick='generateProjectPdfById(".$row->id.", false)'>Download</button>");
        }

        //Log::debug('Array proyectos:'.json_encode($arrProjList));
        $viewData['project_list'] = json_encode($arrProjList);
        $viewData['selected_project'] = is_null($project_id)?'null':$project_id;
        $viewData['decision_map'] = is_null($show_phases)?'false':($show_phases=='true'?'true':'false');

        $viewData['url_logout'] = env('APP_URL').'/admin/logout';

        return view('home', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
