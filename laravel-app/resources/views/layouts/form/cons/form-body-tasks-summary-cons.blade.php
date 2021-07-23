<div class="row div-section-summary">
    <span class="main-title">Tareas</span>
</div>
<div class="row div-section-summary">
    <div class="col-8 np" aria-expanded="false" >
        <span class="sub-title">Puntos clave</span>
        @foreach ($task_list as $task)
            @if($task->is_sub_task=="0" || $task->is_sub_task=="2")
                <div class="row summary-row">
                    <div class="col-7 task-description">
                        <div class="row">
                            <div class="col-11">
                                <span>{{$task->name}}<i class="fa fa-info-circle tooltip-task-info" data-toggle="tooltip" data-placement="top" style="{{$task->tooltip!=''?'':'display:none;'}}" title="{{$task->tooltip}}"></i></span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-5" >
                        <div class="row">
                            <div class="progress col-8" style="padding-left:0px; padding-right:0px;">
                                <div class="task-progress-bar progress-bar bg-success" id="tbp_{{$task->id}}" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    25%
                                </div>
                            </div>
                            <div class="col-1 indicator align-self-center">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-3">
        <span class="sub-title">Departamentos involucrados</span>
        @php
            $deps = array();
        @endphp
        <div class="row">
            @foreach ($task_list as $task)
                @if($task->department_name!="" && !in_array($task->department_name, $deps) )
                    @php
                        array_push($deps, $task->department_name)
                    @endphp
                    <div class="card">
                        <img class="img-card mx-auto" src="/images/icons/dep_{{strtolower($task->department_name)}}.png" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$task->department_name}}</h5>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>