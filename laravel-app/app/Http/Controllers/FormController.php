<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Office365\SharePoint\ClientContext;
use Office365\SharePoint\FileCreationInformation;
use Office365\SharePoint\File as SPFile;
use App\Http\Utils\SomLogger;
use App\Http\Utils\Operation;
use App\Http\Utils\UserPrivileges;
use App\Http\Utils\ViewModelPrivilege;
use App\Http\Utils\CRUDBooster;
use SomController;

class FormController extends Controller
{

    /**
     * Load a Project Milestone Form
     *
     * @return Response
     */
    public function load($id)
    {
        //check if user is logged
        $user_id = Auth::id();

        if ($user_id == null || $user_id == '') {
            $urlactual = \URL::full();
            return redirect(CRUDBooster::adminPath() . "/loginhome?return_url=" . urlencode($urlactual));
        }
        $viewData['userid']     =   $user_id;
        $viewData['username']   =   Auth::user()->name;
        $viewData['userphoto']  =   '../' . CRUDBooster::myPhoto();
        $viewData['formId'] = $id;

        //1) Get Project Info
        $queryValues = "select p.name as project_name, c.country as project_country,
                        ph.name as phase_name, f.name as form_name,
                        p.id as project_id , a.img_url as project_image
                        from som_projects p
                        inner join som_projects_phases pph on p.id=pph.som_projects_id
                        inner join som_phases ph on ph.id=pph.som_phases_id
                        inner join som_phases_milestones phm on phm.som_projects_phases_id=pph.id
                        inner join som_forms f on f.som_phases_milestones_id = phm.id
                        left join som_country c on p.som_country_id = c.id
                        left join som_projects_airport a on a.id = p.som_projects_airport_id
                        where f.id=:form_id and f.active=1";

        //If not found project info return to Home
        $projectFormInfo = DB::select(DB::raw($queryValues), array('form_id' => $id));
        if ($projectFormInfo == null) {
            SomLogger::error("ERR1007", 'Form Info not found');
            return redirect('home');
        }
        $projectFormInfo = collect($projectFormInfo)->first();

        $viewData['project_form_info'] = $projectFormInfo;

        $projectId = $projectFormInfo->project_id;
        $viewData['projectId'] = $projectId;

        $userRole = (DB::table('som_project_users')
            ->where(
                [
                    ["cms_users_id", "=", $user_id],
                    ["som_projects_id", "=", $projectId]
                ]
            )->first())->cms_privileges_id;

        //Check if the user does not have a project role and is not SuperAdmin or SomAdmin
        if (
            $userRole == null
            && CRUDBooster::myPrivilegeId() != UserPrivileges::SuperAdmin
            && CRUDBooster::myPrivilegeId() != UserPrivileges::AdminInternal
        ) {
            SomLogger::error("ERR1008", 'Trying to access unauthorized form');
            return redirect('home');
        }
        //2) Get Task List
        $queryTaskList = "select t.id, t.order, t.name, t.request_date as request_date, t.duedate, t.task_completion_date as completion_date,
                        t.comment, t.support_doc_url as doc_url, t.support_doc_description as doc_description,
                        t.som_departments_users_id as responsible_id, t.som_departments_id as departments_id,
                        t.som_status_id as status_id,
                        t.is_sub_task, t.tooltip, du.cms_users_id as default_users_id, t.cms_users_id,
                        dep.name as department_name,
                        CASE WHEN t.cms_privileges_role_id IS NOT NULL THEN
                            CASE WHEN (t.cms_privileges_role_id = :roleLegal_1 OR t.cms_privileges_role_id = :roleFinance_1) AND t.cms_privileges_role_id = :userRole THEN
                                1
                            ELSE
                                0
                            END
                        ELSE
                            0
                        END as has_role_exception,
                        CASE WHEN t.cms_privileges_role_id IS NOT NULL THEN
                            CASE WHEN t.cms_privileges_role_id = :roleLegal_2 THEN
                                'Legal'
                            WHEN t.cms_privileges_role_id = :roleFinance_2 THEN
                                'Finance'
                            ELSE
                                ''
                            END
                        ELSE
                            ''
                        END as role_name,
                        t.consultable_user_name as consultable_user_name,
						t.consultable_user_email as consultable_user_email
                        from som_forms f
                        inner join som_form_tasks t on t.som_forms_id=f.id
                        left outer join som_departments dep on t.som_departments_id=dep.id
                        left outer join som_departments_users du on t.som_departments_users_id = du.id

                        where f.id=:form_id
                        order by t.order";

        $taskList = DB::select(
            DB::raw($queryTaskList),
            array(
                'form_id' => $id,
                'userRole' => $userRole,
                'roleLegal_1' => UserPrivileges::Legal,
                'roleFinance_1' => UserPrivileges::Finance,
                'roleLegal_2' => UserPrivileges::Legal,
                'roleFinance_2' => UserPrivileges::Finance
            )
        );

        $viewData['task_list'] = $taskList;

        $responsibleArray = array();

        //Get Responsibles of each Department's Task
        foreach ($taskList as $task) {

            if ($task->departments_id != null && $task->departments_id != 0) {
                $queryResponsibles = "SELECT u.id, u.name
                                    FROM som_departments_users du inner join cms_users u on u.id=du.cms_users_id
                                    where du.som_departments_id = :dep_id
                                    order by u.name";
                $responsibleArray[$task->id] = DB::select(DB::raw($queryResponsibles), array('dep_id' => ($task->departments_id)));
            } else {
                $queryResponsibles = "SELECT u.id, u.name
                                    FROM cms_users u
                                    order by u.name";
                $responsibleArray[$task->id] = DB::select(DB::raw($queryResponsibles));
            }
        }

        //Log::debug('Listado de responsables: '.json_encode($responsibleArray));
        $viewData['responsibles_list'] = $responsibleArray;

        //3) Get Control Elements
        $queryElementList = "SELECT e.id, e.order_elements, e.name, e.lastupdate,
                            e.document as doc_url, e.doc_url_description as doc_description,
                            e.template, e.template_url_description as template_description,
                            e.comment, e.is_sub_element, e.tooltip, e.is_mandatory,
                            CASE WHEN e.cms_privileges_role_id IS NOT NULL THEN
                                CASE WHEN (e.cms_privileges_role_id = :roleLegal_1 OR e.cms_privileges_role_id = :roleFinance_1) AND e.cms_privileges_role_id = :userRole THEN
                                    1
                                ELSE
                                    0
                                END
                            ELSE
                                0
                            END as has_role_exception,
                            CASE WHEN e.cms_privileges_role_id IS NOT NULL THEN
                                CASE WHEN e.cms_privileges_role_id = :roleLegal_2 THEN
                                    CASE WHEN e.is_mandatory=1 THEN 'Legal (mandatory)' ELSE 'Legal' END
                                WHEN e.cms_privileges_role_id = :roleFinance_2 THEN
                                    CASE WHEN e.is_mandatory=1 THEN  'Finance (mandatory)' ELSE 'Finance' END
                                ELSE
                                    CASE WHEN e.is_mandatory=1 THEN '(mandatory)' ELSE '' END
                                END
                            ELSE
                                CASE WHEN e.is_mandatory=1 THEN '(mandatory)' ELSE '' END
                            END as role_name_and_mandatory
                            from som_forms f inner join som_form_elements e on e.som_forms_id=f.id
                            where f.id=:form_id
                            and f.active=1
                            order by e.order_elements";

        $elementList = DB::select(
            DB::raw($queryElementList),
            array(
                'form_id' => $id,
                'userRole' => $userRole,
                'roleLegal_1' => UserPrivileges::Legal,
                'roleFinance_1' => UserPrivileges::Finance,
                'roleLegal_2' => UserPrivileges::Legal,
                'roleFinance_2' => UserPrivileges::Finance
            )
        );
        $viewData['element_list'] = $elementList;
        //Log::debug('Listado de elements: '.json_encode($elementList));

        //4) Get Approvals List
        $queryApprovalList = "SELECT a.id, a.order_approval, a.name, ar.lastupdate,
                                ar.document_url as document, ar.doc_url_description as doc_description,
                                ar.comment, ar.som_status_id as status_id, ar.cms_privilege_id_assigned,
                                ar.id as approval_resp_id, s.is_behaviour_review, ar.is_final_approval
                                from som_forms f
                                inner join som_form_approvals a on a.som_forms_id=f.id
                                inner join som_approvals_responsible ar on ar.som_form_approvals_id = a.id
                                left outer join som_status s on s.id=ar.som_status_id
                                where f.id=:form_id
                                and f.active=1
                                order by a.order_approval";

        $approvalList = DB::select(DB::raw($queryApprovalList), array('form_id' => $id));
        $viewData['approval_list'] = $approvalList;
        //Log::debug('Listado de approvals: '.json_encode($approvalList));

        $approvalStatusArray = array();
        $approvalStatusActive = array();

        $OkStatusId = (DB::table('som_status')
            ->where([["name", "=", "Done"], ["type", "=", "approvals"]])->first())->id;

        //Get Approval Status Info
        foreach ($approvalList as $index => $approval) {
            //4.1) Check if Approval Switch is Active

            //If its first Approval
            if ($index == 0) {

                //If is allowed for current user
                if (
                    $approval->cms_privilege_id_assigned == null
                    || $this->checkUserProjectPrivilege($projectId, $user_id, $approval->cms_privilege_id_assigned) == true
                ) {
                    //Activate current switch
                    $approvalStatusActive[$index] = true;
                }
            }
            //If its not checked
            else if ($approval->status_id == null) {

                $indexPrev = $index - 1;

                //If previous Approval is checked AND previous is not is_behaviour_review AND is allowed for current user
                if (
                    $approvalList[$indexPrev]->status_id != null
                    && $approvalList[$indexPrev]->is_behaviour_review != 1
                    && ($approval->cms_privilege_id_assigned == null
                        || $this->checkUserProjectPrivilege($projectId, $user_id, $approval->cms_privilege_id_assigned) == true)
                ) {

                    //Activate current switch
                    $approvalStatusActive[$index] = true;
                } else {
                    //current switch is disabled
                    $approvalStatusActive[$index] = false;
                }
            }
            //If its checked
            else {

                $indexPrev = $index - 1;
                $approvalStatusActive[$index] = false;

                //If previous Approval is checked and is allowed for current user
                if (
                    $approvalList[$indexPrev]->status_id != null
                    && ($approval->cms_privilege_id_assigned == null
                        || $this->checkUserProjectPrivilege($projectId, $user_id, $approval->cms_privilege_id_assigned) == true)
                ) {

                    //Activate current switch
                    $approvalStatusActive[$index] = true;
                }

                //If its checked and its no is_behaviour_review
                if ($approval->is_behaviour_review != 1) {
                    //Disable previous switch
                    $approvalStatusActive[$indexPrev] = false;
                }
            }

            //4.2) Get Available Status for current Approval
            //Log::debug('Status active: '.$approvalStatusActive[$index]);

            $queryStatusApproval = "SELECT sa.som_status_id as status_id, s.name
                                    FROM som_status_approvals sa
                                    inner join som_status s on sa.som_status_id=s.id
                                    where sa.som_approvals_responsible_id=:approval_resp_id
                                    order by sa.status_order";

            $approvalStatusArray[$approval->id] = DB::select(DB::raw($queryStatusApproval), array('approval_resp_id' => ($approval->approval_resp_id)));
        }

        //Log::debug('Listado de status de approvals: '.json_encode($approvalStatusArray));
        $viewData['approval_status_list'] = $approvalStatusArray;
        $viewData['approval_status_active'] = $approvalStatusActive;
        //Log::debug('Listado de status activados: '.json_encode($approvalStatusActive));

        //5) Get Previous and Next Milestones
        $queryMilestones = "select f.id, phm.name
                            from som_forms f inner join som_phases_milestones phm on phm.id=f.som_phases_milestones_id
                            inner join som_projects_phases pph on phm.som_projects_phases_id=pph.id
                            where pph.som_projects_id=:project_id
                            and f.active=1
                            order by pph.order, phm.order";

        $milestonesList = DB::select(DB::raw($queryMilestones), array('project_id' => $projectFormInfo->project_id));

        //Log::debug('Listado de milestones: '.json_encode($milestonesList));

        $i = 0;
        $milestoneSize = count($milestonesList);
        foreach ($milestonesList as $milestone) {
            //Si es Milestone Actual
            if ($milestone->id == $id) {

                //Si no es el primero
                if ($i > 0) {
                    $viewData['prev_milestone'] = $milestonesList[$i - 1];
                }

                //Si no es el ultimo
                if ($i < $milestoneSize - 1) {
                    $viewData['next_milestone'] = $milestonesList[$i + 1];
                }
            }
            $i++;
        }
        //Check Privileges
        if(!empty($taskList))
            $viewData['taskEditAllowed'] = $this->isAllowed('task', $taskList[0]->id, Operation::ValidateAccess);
        if(!empty($elementList))
            $viewData['elementEditAllowed'] = $this->isAllowed('element', $elementList[0]->id, Operation::ValidateAccess);
        if(!empty($approvalList))
            $viewData['approvalEditAllowed'] = $this->isAllowed('approval', $approvalList[0]->id, Operation::Edit);
//        dd($viewData);
        return view('form', $viewData);
    }

    public function findUser(Request $request)
    {

        try {

            $term = $request->input('search_term');
            $searchAll = true;

            if (strpos($term, ' ')) {
                $searchAll = false;
            }

            //Find groups Users:
            $queryLdap = Adldap::search()
                ->select(array('displayname', 'userprincipalname'))
                ->where('objectClass', '=', 'person')
                ->where('userprincipalname', '*')
                ->where('userprincipalname', 'contains', '@');

            if ($searchAll) {
                $queryLdap->orWhere('userprincipalname', 'contains', $term)->orWhere('displayname', 'contains', $term);
            } else {
                foreach (explode(" ", $term) as $t) {
                    $queryLdap->where('displayname', 'contains', $t);
                }
            }
            $queryResults = $queryLdap->limit(15)->get();

            $users = array();

            foreach ($queryResults as $u) {

                $user = [
                    'id' => $u['userprincipalname'][0],
                    'text' => $u['displayname'][0]
                ];
                array_push($users, $user);
            }

            return $users;
        } catch (\Exception $e) {
            $resultRQ['api_http'] = 500;
            $resultRQ['api_status'] = "KO";
            $resultRQ['api_message'] = "No valid request!";
        }
    }

    /**
     * Recieve the form saveConsulted submission
     */
    public function saveConsulted(Request $request)
    {
        $resultRQ = array();

        try {
            $taskId = $request->input('consulted_taskId');
            $name = $request->input('consulted_name');
            $email = $request->input('consulted_email');


            if ($taskId == null) {
                $resultRQ['api_http'] = 500;
                $resultRQ['api_status'] = "KO";
                $resultRQ['api_message'] = "Task ID is missing!";
                return $resultRQ;
            }

            if ($name == null) {
                $name = $email;
            }

            if ($email != null) {
                DB::table('som_form_tasks')
                    ->where('id', $taskId)
                    ->update(['consultable_user_name' => $name, 'consultable_user_email' => $email]);
                $resultRQ['data'] = true;
            } else {
                DB::table('som_form_tasks')
                    ->where('id', $taskId)
                    ->update(['consultable_user_name' => null, 'consultable_user_email' => null]);
                $resultRQ['data'] = false;
            }


            $resultRQ['api_http'] = 200;
            $resultRQ['api_status'] = "OK";
            $resultRQ['api_message'] = "";
            return $resultRQ;
        } catch (\Exception $e) {
            $resultRQ['api_http'] = 500;
            $resultRQ['api_status'] = "KO";
            $resultRQ['api_message'] = "No valid request!";
        }

        return $resultRQ;
    }

    /**
     * Recieve the form info submission
     */
    public function submit(Request $request)
    {

        SomLogger::debug("DBG1001", 'Submit data...');

        $currentUserId = Auth::id();

        $response = "true";

        //check if user is logged
        if ($currentUserId != null && $currentUserId != '') {

            $formType = $request->input('formType');
            //Log::debug('Form Type: '.$formType);

            //1) Check Form Type submited

            //Task: DocumentURL
            if ($formType == 'taskDocUrl') {

                //Check Privileges
                $taskId = $request->input('taskId');
                $projectId = $request->input('projectId');

                if (!$this->isAllowed('task', $taskId, Operation::Edit)) {
                    return "false";
                }

                #$doc = $request->input('doc');
                $description = $request->input('description');

                $fileName = $request->input('originalDoc');

                if ($request->doc != null) {

                    //Check max size
                    if ($request->doc->getSize() > env('UPLOAD_MAX_SIZE') * 1000000) {
                        return "error.maxsize";
                    }

                    //Check Project Folder
                    $projectFolder = (DB::table('som_projects')->where([["id", "=", $projectId]])->first())->documentation_folder;

                    if ($projectFolder == '') {
                        SomLogger::error("ERR1015", "Project {$projectId} doesn't have any sharepoint folder configured");
                        return "error.projectFolder";
                    }

                    $fileName = $request->doc->getClientOriginalName();
                    SomLogger::debug("DBG1001", "TaskDocUrl: {$projectFolder}, {$fileName} , {$description}");
                    //$response =  $this->uploadFileToSharepoint($request->doc, $projectFolder, "t{$taskId}_doc_{$fileName}");
                    $response =  $this->uploadFileToSharepoint($projectId, $formType, $taskId, $request->doc, "t{$taskId}_doc_{$fileName}");

                    //If upload has error return error
                    if ($response != 'true') {
                        return $response;
                    }
                }

                $queryUpdateTaskDoc = "update som_form_tasks set
                support_doc_url=:doc,
                support_doc_description=:description
                where id=:taskId";

                DB::update(DB::raw($queryUpdateTaskDoc), array('taskId' => $taskId, 'doc' => $fileName, 'description' => $description));
            }
            //Task: Info
            else if ($formType == "taskInfo") {

                //Check Privileges
                $taskId = $request->input('taskId');
                if (!$this->isAllowed('task', $taskId, Operation::Edit)) {
                    return "false";
                }
                $responsibleId  = $request->input('responsibleId');


                $comment = $request->input('comment');
                $deadline = $request->input('deadline');

                if ($deadline != null && $deadline != '') {
                    $deadline = DateTime::createFromFormat('d/m/Y', $deadline);
                }


                $na_            = $request->input('na_');
                $done_          = $request->input('done_');
                $oldStatusId    = null; //$request->input('oldStatusId');

                //Log::debug('TaskInfo: '.$taskId.' '.$responsibleId.' '.$comment.' '.json_encode($deadline));
                //Log::debug('TaskInfo Check: NA:'.$na_.' DONE:'.$done_);

                //Obtenemos oldStatusId
                $queryOldStatus = "select som_status_id as id from som_form_tasks where id=:taskId";
                $oldStatusList = DB::select(DB::raw($queryOldStatus), array('taskId' => $taskId));

                if ($oldStatusList != null) {
                    $oldStatusId = (collect($oldStatusList)->first())->id;
                }
                SomLogger::debug("DBG1001", 'Task Old Status: ' . $oldStatusId);

                //Get Current Task Status
                $statusId = null;
                $statusName = null;
                if ($na_ == "1") {
                    $statusName = "Not applicable";
                } else if ($done_ == "1") {
                    $statusName = "Done";
                }

                $statusId = (DB::table('som_status')
                    ->where([["name", "=", $statusName], ["type", "=", "tasks"]])->first())->id;

                SomLogger::debug("DBG1001", 'Task New Status: ' . $statusId);


                //If change Task Status update Task Completion Date
                if ($oldStatusId != $statusId) {
                    SomLogger::debug("DBG1001", 'Cambiamos estado de Task');
                    $date = null;

                    if ($statusId != null) {
                        $date = new DateTime();
                    }
                    SomLogger::debug("DBG1001", 'Update Date: ' . json_encode($date));

                    $queryUpdateTaskInfo = "update som_form_tasks set
                                            cms_users_id=:responsibleId,
                                            comment=:comment,
                                            duedate=:deadline,
                                            som_status_id=:statusId,
                                            task_completion_date=:date
                                            where id=:taskId";

                    DB::update(DB::raw($queryUpdateTaskInfo), array('taskId' => $taskId, 'responsibleId' => $responsibleId, 'comment' => $comment, 'statusId' => $statusId, 'deadline' => $deadline, 'date' => $date));
                }
                //If dont change status
                else {

                    $queryUpdateTaskInfo = "update som_form_tasks set
                                            cms_users_id=:responsibleId,
                                            comment=:comment,
                                            duedate=:deadline,
                                            som_status_id=:statusId
                                            where id=:taskId";

                    DB::update(DB::raw($queryUpdateTaskInfo), array('taskId' => $taskId, 'responsibleId' => $responsibleId, 'comment' => $comment, 'statusId' => $statusId, 'deadline' => $deadline));
                }
            }
            //Element: Info
            else if ($formType == "elementInfo") {

                //Check Privileges
                $elementId = $request->input('elementId');
                if (!$this->isAllowed('element', $elementId, Operation::Edit)) {
                    return "false";
                }

                $comment = $request->input('comment');
                $date = new DateTime();

                $queryUpdateEleInfo = "update som_form_elements set
                                        comment=:comment,
                                        lastupdate=:date
                                        where id=:elementId";

                DB::update(DB::raw($queryUpdateEleInfo), array('elementId' => $elementId,  'comment' => $comment, 'date' => $date));
            }
            //Element: Template URL
            else if ($formType == "elementTemplateUrl") {

                //Check Privileges
                $elementId = $request->input('elementId');
                $projectId = $request->input('projectId');

                if (!$this->isAllowed('element', $elementId, Operation::Edit)) {
                    return "false";
                }

                #$doc = $request->input('doc');
                $description = $request->input('description');
                $date = new DateTime();

                $fileName = $request->input('originalDoc');

                if ($request->doc != null) {
                    //Check max size
                    if ($request->doc->getSize() > env('UPLOAD_MAX_SIZE') * 1000000) {
                        return "error.maxsize";
                    }

                    //Check Project Folder
                    $projectFolder = (DB::table('som_projects')->where([["id", "=", $projectId]])->first())->documentation_folder;

                    if ($projectFolder == '') {
                        SomLogger::error("ERR1015", "Project {$projectId} doesn't have any sharepoint folder configured");
                        return "error.projectFolder";
                    }

                    $fileName = $request->doc->getClientOriginalName();
                    SomLogger::debug("DBG1001", "ElementTemplateUrl: {$projectFolder}, {$fileName} , {$description}");
                    //$response =  $this->uploadFileToSharepoint($request->doc, $projectFolder, "ec{$elementId}_tem_{$fileName}");
                    $response =  $this->uploadFileToSharepoint($projectId, $formType, $elementId, $request->doc, "ec{$elementId}_tem_{$fileName}");

                    //If upload has error return error
                    if ($response != 'true') {
                        return $response;
                    }
                }

                $queryUpdateEleTemp = "update som_form_elements set
                                        template=:doc,
                                        template_url_description=:description,
                                        lastupdate=:date
                                        where id=:elementId";


                DB::update(DB::raw($queryUpdateEleTemp), array('elementId' => $elementId, 'doc' => $fileName, 'description' => $description, 'date' => $date));
            }
            //Element: Doc URL
            else if ($formType == "elementDocUrl") {

                //Check Privileges
                $elementId = $request->input('elementId');
                $projectId = $request->input('projectId');

                if (!$this->isAllowed('element', $elementId, Operation::Edit)) {
                    return "false";
                }

                #$doc = $request->input('doc');
                $description = $request->input('description');
                $date = new DateTime();

                $fileName = $request->input('originalDoc');

                if ($request->doc != null) {

                    //Check max size
                    if ($request->doc->getSize() > env('UPLOAD_MAX_SIZE') * 1000000) {
                        return "error.maxsize";
                    }

                    //Check Project Folder
                    $projectFolder = (DB::table('som_projects')->where([["id", "=", $projectId]])->first())->documentation_folder;

                    if ($projectFolder == '') {
                        SomLogger::error("ERR1015", "Project {$projectId} doesn't have any sharepoint folder configured");
                        return "error.projectFolder";
                    }

                    $fileName = $request->doc->getClientOriginalName();
                    SomLogger::debug("DBG1001", "ElementDocUrl: {$projectFolder}, {$fileName} , {$description}");
                    //$response =  $this->uploadFileToSharepoint($request->doc, $projectFolder, "ec{$elementId}_doc_{$fileName}");
                    $response =  $this->uploadFileToSharepoint($projectId, $formType, $elementId, $request->doc, "ec{$elementId}_doc_{$fileName}");

                    //If upload has error return error
                    if ($response != 'true') {
                        return $response;
                    }
                }

                $queryUpdateEleDoc = "update som_form_elements set
                                        document=:doc,
                                        doc_url_description=:description,
                                        lastupdate=:date
                                        where id=:elementId";

                DB::update(DB::raw($queryUpdateEleDoc), array('elementId' => $elementId, 'doc' => $fileName, 'description' => $description, 'date' => $date));
            }
            //Approval: Doc URL
            else if ($formType == "approvalDocUrl") {

                //Check Privileges
                $approvalId = $request->input('id');
                $projectId = $request->input('projectId');
                if (!$this->isAllowed('approval', $approvalId, Operation::Edit)) {
                    return "false";
                }

                $appRespId = $request->input('appRespId');
                #$doc = $request->input('doc');
                $description = $request->input('description');
                $date = new DateTime();

                $fileName = $request->input('originalDoc');

                if ($request->doc != null) {

                    //Check max size
                    if ($request->doc->getSize() > env('UPLOAD_MAX_SIZE') * 1000000) {
                        return "error.maxsize";
                    }

                    //Check Project Folder
                    $projectFolder = (DB::table('som_projects')->where([["id", "=", $projectId]])->first())->documentation_folder;

                    if ($projectFolder == '') {
                        SomLogger::error("ERR1015", "Project {$projectId} doesn't have any sharepoint folder configured");
                        return "error.projectFolder";
                    }

                    $fileName = $request->doc->getClientOriginalName();
                    SomLogger::debug("DBG1001", "ApprovalDocUrl: {$projectFolder}, {$fileName} , {$description}");
                    //$response =  $this->uploadFileToSharepoint($request->doc, $projectFolder, "a{$approvalId}_doc_{$fileName}");
                    $response =  $this->uploadFileToSharepoint($projectId, $formType, $approvalId, $request->doc, "a{$approvalId}_doc_{$fileName}");

                    //If upload has error return error
                    if ($response != 'true') {
                        return $response;
                    }
                }

                $queryUpdateEleInfo = "update som_approvals_responsible set
                                        document_url=:doc,
                                        doc_url_description=:description,
                                        lastupdate=:date
                                        where id=:appRespId";

                DB::update(DB::raw($queryUpdateEleInfo), array('appRespId' => $appRespId, 'doc' => $fileName, 'description' => $description, 'date' => $date));
            }
            //Approval: Info
            else if ($formType == "approvalInfo") {

                //Check Privileges
                $approvalId = $request->input('id');
                if (!$this->isAllowed('approval', $approvalId, Operation::Edit)) {
                    return "false";
                }

                //Read form params
                $formId     = $request->input('formId');
                $appRespId  = $request->input('appRespId');
                $comment    = $request->input('comment');
                $approvalDate = $request->input('approvalDate');

                $ok_          = $request->input('ok_');
                $cancel_      = $request->input('cancel_');
                $review_      = $request->input('review_');
                $na_          = $request->input('na_');
                SomLogger::debug("DBG1001", 'ApprovalStatus: OK:' . $ok_ . ' Cancel:' . $cancel_ . ' Review:' . $review_ . ' NA:' . $na_);

                //Get oldStatusId
                $oldStatusId    = null;
                $queryOldStatus = "select som_status_id as id from som_approvals_responsible where id=:appRespId";
                $oldStatusList = DB::select(DB::raw($queryOldStatus), array('appRespId' => $appRespId));

                if ($oldStatusList != null) {
                    $oldStatusId = (collect($oldStatusList)->first())->id;
                }
                SomLogger::debug("DBG1001", 'Approval OldStatus: ' . $oldStatusId);

                //Get Current Status
                $statusId = null;

                $statusName = null;
                if ($na_ == "1") {
                    $statusName = "Not applicable";
                    //$statusId=11;
                } else if ($ok_ == "1") {
                    $statusName = "Done";
                    //$statusId=6;
                } else if ($cancel_ == "1") {
                    $statusName = "Rejected";
                    //$statusId=8;
                } else if ($review_ == "1") {
                    $statusName = "Review";
                    //$statusId=7;
                }

                $newStatus = (DB::table('som_status')
                    ->where([["name", "=", $statusName], ["type", "=", "approvals"]])->first());

                SomLogger::debug("DBG1001", 'Approval New Status: ' . $newStatus->id);


                //If Change Approval Status
                if ($oldStatusId != $newStatus->id) {

                    SomLogger::debug("DBG1001", 'Change Approval status');
                    $date = null;

                    //Update Approval's Date
                    if ($newStatus->id != null) {
                        $date = new DateTime();
                    }
                    SomLogger::debug("DBG1001", 'Update Approval Date: ' . json_encode($date));

                    $queryUpdateEleInfo = "update som_approvals_responsible set
                                            comment=:comment,
                                            lastupdate=:date,
                                            som_status_id=:statusId
                                            where id=:appRespId";

                    DB::update(DB::raw($queryUpdateEleInfo), array('appRespId' => $appRespId,  'comment' => $comment, 'date' => $date, 'statusId' => ($newStatus->id)));


                    //Si es un estado `is_behaviour_review` desactivamos todos los approvals
                    if ($newStatus->is_behaviour_review == 1) {
                        SomLogger::debug("DBG1001", 'is_behaviour_review: remove other approvals status');
                        $queryUpdateReview = "update som_form_approvals a
                                            inner join 	som_approvals_responsible ar on ar.som_form_approvals_id = a.id
                                            set ar.som_status_id=null,
                                            ar.lastupdate=:date
                                            where a.som_forms_id=:formId
                                            and ar.som_status_id!=:statusId ";

                        DB::update(DB::raw($queryUpdateReview), array('formId' => $formId, 'date' => null, 'statusId' => ($newStatus->id)));
                    }

                    //Si se setea nuevo estado
                    if ($newStatus->id != null) {

                        //Check if must notify
                        $approval = DB::table('som_approvals_responsible')
                            ->where([
                                ['som_approvals_responsible.id', $appRespId],
                                ['som_approvals_responsible.cms_privilege_id_notify', '<>', NULL]
                            ])
                            ->select(
                                'som_approvals_responsible.cms_privilege_id_notify AS id_notify'
                            )
                            ->first();

                        SomLogger::debug("DBG1001", 'Is Approval Notify: ' . json_encode($approval));
                    }
                } else {

                    if ($approvalDate != null && $approvalDate != '') {
                        $approvalDate = DateTime::createFromFormat('d/m/Y', $approvalDate);
                    }

                    $queryUpdateEleInfo = "update som_approvals_responsible set
                                            comment=:comment,
                                            lastupdate=:approvalDate
                                            where id=:appRespId";

                    DB::update(DB::raw($queryUpdateEleInfo), array('appRespId' => $appRespId,  'comment' => $comment, 'approvalDate' => $approvalDate));
                }
            }
            return $response;
        }
        //If user is not logged
        else {
            SomLogger::error("ERR1010", 'User not logged');
            return "false";
        }
    }

    /**
     * Check if current user is allowed to modify a form section (task, element, approval)
     * - operation:
     *      - Operation::ValidateAccess -> check if an user can operate with a section of form (not including Legal and Finance roles)
     *      - Operation::Edit -> check if an user can update info of a form section (including Legal and Finance roles)
     *
     * @return true/false
     */
    private function isAllowed($sectionType, $id, $operation)
    {
        //TODO: Fix this to work...big surprise.
        //$allowed = false;

        // if ($sectionType == 'task') {
        //     $allowed = SOMController::getUserProjectPrivileges(ViewModelPrivilege::ProjectPhasesMilestonesFormsTasks, $operation, $query, $id);
        // } else if ($sectionType == 'element') {
        //     $allowed = SOMController::getUserProjectPrivileges(ViewModelPrivilege::ProjectPhasesMilestonesFormsElements, $operation, $query, $id);
        // } else if ($sectionType == 'approval') {
        //     $allowed = SOMController::getUserProjectPrivileges(ViewModelPrivilege::ProjectPhasesMilestonesFormsApprovals, $operation, $query, $id);
        // }

        //Log::debug('Check Is Allowed: '.$sectionType.' - Operation:'.$operation.' - Id: '.$id.' --> '.$allowed);

        return true;
        //return $allowed;
    }

    /**
     * Check If a user has a privilege on a project
     *
     * @return true/false
     */
    private function checkUserProjectPrivilege($projectId, $userId, $privilegeId)
    {

        $hasPrivilege = false;

        $userPrivilege = (DB::table('som_project_users')
            ->where([["som_projects_id", "=", $projectId], ["cms_users_id", "=", $userId], ["cms_privileges_id", "=", $privilegeId]])
            ->first());

        if ($userPrivilege != null) {
            $hasPrivilege = true;
        }

        return $hasPrivilege;
    }

    /**
     * Get Sharepoint Context to invoke Request API
     */
    private function getSharepointContext()
    {
        $spUrl = env("SHAREPOINT_URL");
        SomLogger::debug("DBG1001", "SharePoint url: {$spUrl}");

        //Get SharepointAuthCtx
        $authCtx = Crypt::decrypt(Session::get('SharepointAuthCtx'));
        $authCtx->AuthType = CURLAUTH_NTLM;
        //initialize REST client
        $ctx = new ClientContext($spUrl, $authCtx);
        return $ctx;
    }

    /**
     * Upload a file into Sharepoint from local temp folder
     */
    private function uploadFileIntoFolder(ClientContext $ctx, $localPath, $targetFolderUrl)
    {

        $fileName = basename($localPath);
        $fileCreationInformation = new FileCreationInformation();
        $fileCreationInformation->Content = file_get_contents($localPath);
        $fileCreationInformation->Url = $fileName;
        $uploadFile = $ctx->getWeb()->getFolderByServerRelativeUrl($targetFolderUrl)->getFiles()->add($fileCreationInformation);
        $ctx->executeQuery();
        SomLogger::debug("DBG1001", "File {$uploadFile->getProperty('ServerRelativeUrl')} has been uploaded");

        return "true";
    }

    /**
     * Main function to upload a document into Sharepoint Folder
     */
    private function uploadFileToSharepoint($projectId, $typeDoc, $id, $doc, $fileName)
    {
        try {
            //If dont have SharepointToken
            if (Session::get("SharepointAuthCtx") == null) {
                SomLogger::error("ERR1011", "Error connecting to Sharepoint");
                return "error.login";
            } else {
                //$parentFolderUrl="{$_ENV['SHAREPOINT_ROOT_FOLDER']}/{$projectFolder}";
                $tempFolder = $_ENV["SHAREPOINT_TMP_LOCAL_FOLDER"];
                $sharepointFolder = "{$_ENV['SHAREPOINT_ROOT_FOLDER']}/{$this->getSubFolder($projectId,$typeDoc,$id)}";
                SomLogger::debug("DBG1001", "Sharepointfolder:{$sharepointFolder}");

                //Save doc in local tmp folder
                $doc->storeAs($tempFolder, $fileName);
                //Upload file into Sharepoint
                $this->uploadFileIntoFolder($this->getSharepointContext(), storage_path("app/{$tempFolder}/{$fileName}"), $sharepointFolder);
                //Delete local temp file
                Storage::delete("{$tempFolder}/{$fileName}");
                return "true";
            }
        } catch (\ErrorException $e) {
            SomLogger::error("ERR1012", "Failed upload file to Sharepoint folder. {$e}");
            return "error.sharepoint";
        } catch (\Exception $e) {
            SomLogger::error("ERR1012", "Failed upload file to Sharepoint folder. {$e}");
            return "error.sharepoint";
        }
    }


    /**
     * Download a document from Sharepoint
     */
    public function downloadFile($projectId, $type, $id, $name)
    {
        //check if user is logged and its allowed
        $currentUserId = Auth::user()->id;
        if ($currentUserId == null || $currentUserId == '' || $projectId == '') {
            return false;
        } else {

            $typeAllow = "";
            if ($type == "taskDocUrl") {
                $typeAllow = "task";
            } else if ($type == "elementDocUrl" || $type == "elementTemplateUrl") {
                $typeAllow = "element";
            } else if ($type == "approvalDocUrl") {
                $typeAllow = "approval";
            } else {
                return false;
            }

            if (!$this->isAllowed($typeAllow, $id, Operation::Edit)) {
                return "You don't have permissions to download the document";
            }
        }

        //If dont have SharepointToken
        if (Session::get("SharepointAuthCtx") == null) {
            SomLogger::error("ERR1011", "Error connecting to Sharepoint");
            return "Error connecting to Sharepoint";
        } else {
            SomLogger::debug("DBG1001", "Init Download Document. Type: {$type}, Id: {$id}, Name: {$name}");
            //$url=$_ENV["SHAREPOINT_URL"];
            $parentFolderUrl = env("SHAREPOINT_ROOT_FOLDER");
            $tempFolder = env("SHAREPOINT_TMP_LOCAL_FOLDER");
            $fullFileName = "";

            if ($type == "taskDocUrl") {
                $fullFileName = "t{$id}_doc_{$name}";
            } else if ($type == "elementDocUrl") {
                $fullFileName = "ec{$id}_doc_{$name}";
            } else if ($type == "elementTemplateUrl") {
                $fullFileName = "ec{$id}_tem_{$name}";
            } else if ($type == "approvalDocUrl") {
                $fullFileName = "a{$id}_doc_{$name}";
            }
            //Check Project Folder
            $projectFolder = (DB::table('som_projects')->where([["id", "=", $projectId]])->first())->documentation_folder;

            $fileServerRelativeURL = "{$parentFolderUrl}/{$this->getSubFolder($projectId,$type,$id)}/{$fullFileName}";
            SomLogger::debug("DBG1001", "Full filename: {$fullFileName}, ServerRelativeURL: {$fileServerRelativeURL}");

            $ctx = $this->getSharepointContext();
            if ($this->downloadSPFile($ctx, $fileServerRelativeURL, "{$fullFileName}")) {
                return response()->download(storage_path("app/{$tempFolder}/{$fullFileName}"), $name)->deleteFileAfterSend(true);
            } else {
                abort(500);
            }
        }
    }


    /**
     * Download file from Sharepoint into Local Temp folder
     */
    function downloadSPFile(ClientContext $ctx, $fileServerRelativeURL, $fileName)
    {
        try {
            $tempFolder = env("SHAREPOINT_TMP_LOCAL_FOLDER");
            $fileContent = SPFile::openBinary($ctx, $fileServerRelativeURL);
            Storage::put("{$tempFolder}/{$fileName}", $fileContent);
            SomLogger::debug("DBG1001", 'File downloaded');
            return true;
        } catch (\Exception $e) {
            SomLogger::error("ERR1013", "File download failed");
            return false;
        }
    }

    private function getSubFolder($projectId, $typeDoc, $id)
    {

        SomLogger::debug("DBG1001", "getSubFolder: {$projectId}, {$typeDoc}, {$id}");
        //Get Project Folder
        $projectFolder = (DB::table('som_projects')->where([["id", "=", $projectId]])->first())->documentation_folder;

        $folder = "";
        if ($typeDoc == "taskDocUrl") {

            $queryRes = DB::table('som_form_tasks')
                ->join('som_forms', 'som_forms.id', '=', 'som_form_tasks.som_forms_id')
                ->join('som_departments', 'som_form_tasks.som_departments_id', '=', 'som_departments.id')
                ->join('som_phases_milestones', 'som_phases_milestones.id', '=', 'som_forms.som_phases_milestones_id')
                ->join('som_projects_phases', 'som_projects_phases.id', '=', 'som_phases_milestones.som_projects_phases_id')
                ->join('som_phases', 'som_phases.id', '=', 'som_projects_phases.som_phases_id')
                ->where([["som_form_tasks.id", "=", $id]])
                ->select('som_forms.name as form', 'som_departments.name as department', 'som_phases.name as phase')->first();

            $folder = "{$projectFolder}/{$queryRes->phase}/{$queryRes->form}/Tareas/{$queryRes->department}";
        } else if ($typeDoc == "elementDocUrl" || $typeDoc == "elementTemplateUrl") {
            $queryRes = DB::table('som_form_elements')
                ->join('cms_privileges', 'cms_privileges.id', '=', 'som_form_elements.cms_privileges_role_id')
                ->join('som_forms', 'som_forms.id', '=', 'som_form_elements.som_forms_id')
                ->join('som_phases_milestones', 'som_phases_milestones.id', '=', 'som_forms.som_phases_milestones_id')
                ->join('som_projects_phases', 'som_projects_phases.id', '=', 'som_phases_milestones.som_projects_phases_id')
                ->join('som_phases', 'som_phases.id', '=', 'som_projects_phases.som_phases_id')
                ->where([["som_form_elements.id", "=", $id]])
                ->select('som_forms.name as form', 'cms_privileges.name as role', 'som_phases.name as phase')->first();


            $ecRoleFolder = 'Aena Internacional';

            //Check element Role
            if ($queryRes->role == 'Legal') {
                $ecRoleFolder = 'Legal';
            } else if ($queryRes->role == 'Finance') {
                $ecRoleFolder = 'Financiero';
            }

            $folder = "{$projectFolder}/{$queryRes->phase}/{$queryRes->form}/Elementos de control/{$ecRoleFolder}";
        } else if ($typeDoc == "approvalDocUrl") {

            $queryRes = DB::table('som_form_approvals')
                ->join('som_forms', 'som_forms.id', '=', 'som_form_approvals.som_forms_id')
                ->join('som_phases_milestones', 'som_phases_milestones.id', '=', 'som_forms.som_phases_milestones_id')
                ->join('som_projects_phases', 'som_projects_phases.id', '=', 'som_phases_milestones.som_projects_phases_id')
                ->join('som_phases', 'som_phases.id', '=', 'som_projects_phases.som_phases_id')
                ->where([["som_form_approvals.id", "=", $id]])
                ->select('som_forms.name as form', 'som_phases.name as phase')->first();

            $folder = "{$projectFolder}/{$queryRes->phase}/{$queryRes->form}/Aprobaciones/";
        }

        SomLogger::debug("DBG1001", "SubFolder: {$folder}");

        return $folder;
    }
}
