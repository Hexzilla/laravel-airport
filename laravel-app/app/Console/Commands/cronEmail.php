<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:dueDateTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email when due date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dueDateTasks = DB::select(DB::RAW('
        select p.name as project_name,f.id,ft.id as ft_id,ft.name as task_name,p.email_legal as email_legal,
		p.email_finance as email_finance, priv.name as task_priv_assigned ,
        u.name as project_user,pup.name as project_user_role,u.email as project_user_email ,
        ut.name as task_user_assigned, ut.email as task_user_email
        from som_projects p
			inner join som_projects_phases ph on ph.som_projects_id=p.id
			inner join som_phases_milestones pm on pm.som_projects_phases_id=ph.id
			inner join som_forms f on f.som_phases_milestones_id=pm.id
			inner join som_form_tasks ft on ft.som_forms_id=f.id
			inner join cms_privileges priv on priv.id=ft.cms_privileges_role_id
			inner join som_project_users pu on pu.som_projects_id=p.id
			inner join cms_users u on u.id=pu.cms_users_id
            inner join cms_privileges pup on pup.id=pu.cms_privileges_id
            left join cms_users ut on ut.id=ft.cms_users_id
			where ft.duedate<=curdate() and task_completion_date is null
			order by ft.id'));

        $task_id=0;

        //email setting en el backoffice
        $fromEmail = CRUDBooster::getSetting('email_sender');//"noreply@innovation.es";
        $fromName = CRUDBooster::getSetting('name_sender');//"Administrator";

        foreach($dueDateTasks as $task){

            //several users for each project - project_admins
            if($task_id!=$task->ft_id){
                $task_id=$task->ft_id;
                //check if task are for legal
                if($task->task_priv_assigned=="Legal"){

                    $task->email_type="superior";
                    try{
                        Mail::send(['html'=>'emails.email_duedate'],
                            array('task'=>$task),
                            function($message) use ($task,$fromEmail,$fromName){
                                $message->from($fromEmail,$fromName);
                                $message->subject("GPI – Alerta Tarea " . $task->task_name);
                                $message->to($task->email_legal);
                            }
                        );
                        SomLogger::info("MSG1008",'Email enviado a ' . $task->email_legal );
                    }catch (Exception $e) {
                        SomLogger::error("ERR1014",'Error enviando email ' . $e->message );
                    }

                    echo "\n email sent to" . $task->email_legal;
                }
                //check if task are for finance
                if($task->task_priv_assigned=="Finance"){
                    $task->email_type="superior";
                    try{
                        Mail::send(['html'=>'emails.email_duedate'],
                        array('task'=>$task),
                        function($message) use ($task,$fromEmail,$fromName){
                            $message->from($fromEmail,$fromName);
                            $message->subject("GPI – Alerta Tarea " . $task->task_name);
                            $message->to($task->email_finance);
                        });
                        SomLogger::info("MSG1008",'Email enviado a ' . $task->email_finance );
                    }catch (Exception $e) {
                        SomLogger::error("ERR1014",'Error enviando email ' . $e->message );
                    }
                }

                //send email to task_user
                if(!is_null($task->task_user_email)){
                    $task->email_type="normal";
                    try{
                        Mail::send(['html'=>'emails.email_duedate'],
                        array('task'=>$task),
                        function($message) use ($task,$fromEmail,$fromName){
                            $message->from($fromEmail,$fromName);
                            $message->subject("GPI – Alerta Tarea " . $task->task_name);
                            $message->to($task->task_user_email);
                        });
                        SomLogger::info("MSG1008",'Email enviado a ' . $task->task_user_email );
                    }catch (Exception $e) {
                        SomLogger::error("ERR1014",'Error enviando email ' . $e->message );
                    }
                }

            }

            //send email for each user that is project admin
            if($task->project_user_role=="Project Admin"){
                $task->email_type="superior";
                try{
                    Mail::send(['html'=>'emails.email_duedate'],
                    array('task'=>$task),
                    function($message) use ($task,$fromEmail,$fromName){
                        $message->from($fromEmail,$fromName);
                        $message->subject("GPI – Alerta Tarea " . $task->task_name);
                        $message->to($task->project_user_email);
                    });
                    SomLogger::info("MSG1008",'Email enviado a ' . $task->project_user_email );
                }catch (Exception $e) {
                    SomLogger::error("ERR1014",'Error enviando email ' . $e->message );
                }
            }


        }


    }
}
