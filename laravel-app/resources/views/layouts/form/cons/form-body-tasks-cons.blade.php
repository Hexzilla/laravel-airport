<!-- SECTION 1: Tasks ********************************************************* -->
<div class="row section-title" > 
	<div class="col-12 div-section-title collapsed" data-toggle="collapse" data-target="#task-element-list" aria-expanded="false">
		<span>Tareas</span>
	</div>
</div>
<div id="task-element-list" class="collapse">
	@php
		$taskNumber=0;
		$parentTask=0;
	@endphp
	@foreach ($task_list as $task)
		<!-- Task  *************************************************** -->
		<div class="task-area tasks {{$task->is_sub_task=='1'?'collapse subtask-'.$parentTask:''}} {{$task->is_sub_task=='2'?'main-task':''}}" data-rolevalidationexception="{{($taskEditAllowed || $task->has_role_exception==1)?1:0}}">
			<!-- Task Header-->
			@if($task->is_sub_task=="0")
				<div class="row task-header section-header collapsed" id="{{$task->id}}" data-toggle="collapse" data-target=".subtask-{{$task->id}}">
			@else
				<div class="row task-header section-header collapsed" id="{{$task->id}}" data-toggle="collapse" data-target="#taskBody{{$task->id}}">
			@endif
				<!-- We have now in DDBB an apparently bool field as a type-->
				<!-- is_sub_task 0  Task with no info but subtasks-->
				<!-- is_sub_task 1  subTask-->
				<!-- is_sub_task 2  Task with info and without subtasks-->
				@if($task->is_sub_task=="0" || $task->is_sub_task=="2")
					@php
						$parentTask=$task->id;
						$taskNumber++
					@endphp
					<div class="col-1 task-order">
						<span>{{$taskNumber}}</span>
					</div>
					<div class="col-11 task-description">
						<div class="row">
							<div class="col-11">
								<span>{{$task->name}}
								<i class="mandatory-field" style="">{{$task->role_name}}</i>
								<i class="fa fa-info-circle tooltip-task-info" data-toggle="tooltip" data-placement="top" style="{{$task->tooltip!=''?'':'display:none;'}}" title="{{$task->tooltip}}"></i>
								</span>
							</div>

							<div class="col-1 indicator align-self-center">
								<span></span>
							</div>
						</div>
					</div>
				@else
					<div class="col-1">&nbsp;</div>
					<div class="col-1 subtask-order">
						<span>&nbsp;</span>
					</div>
					<div class="col-10 task-description" >
						<div class="row">
							<div class="col-11">
								<span>{{$task->name}}
								<i class="mandatory-field" style="">{{$task->role_name}}</i>
								<i class="fa fa-info-circle tooltip-task-info" data-toggle="tooltip" data-placement="top" style="{{$task->tooltip!=''?'':'display:none;'}}" title="{{$task->tooltip}}"></i></span>
							</div>
							<div class="col-1 indicator align-self-center">
								<span></span>
							</div>
						</div>
					</div>
				@endif
			</div>
			@if($task->is_sub_task!="0")
				<!-- Task Body -->
				<div class="collapse" id="taskBody{{$task->id}}">
					@if($taskEditAllowed || $task->has_role_exception==1)
						<form action="/form/submit" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" name="formType" value="taskDocUrl">
							<input type="hidden" name="taskId" value="{{$task->id}}">
							<input type="hidden" name="id" value="{{$task->id}}">
							<input type="hidden" name="projectId" value="{{$projectId}}">
							<!-- Modal Document URL -->
							<div class="modal fade" id="docUrlModal_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="vertical-alignment-helper">
									<div class="modal-dialog vertical-align-center">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" style="" id="myModalLabel">Documento</h4>
											</div>
											<div class="modal-body">
												<label for="doc1">Documento:</label>
												<div class="input-group" style="margin-bottom: 1rem; {{$task->doc_url!=''?'':'display:none;'}}">
													<span class="input-group-btn">
														<button class="btn btn-secondary" style="font-weight: bold;" type="button" onclick="removeFileDoc('docUrl',{{$task->id}})">Eliminar archivo</button>
													</span>
													<input type="text" class="form-control" name="originalDoc" readonly value="{{$task->doc_url}}">
												</div>
												<div class="form-group" style="{{$task->doc_url!=''?'display:none;':''}}">
													<input type="file" class="form-control filestyle" name="doc" data-buttonBefore="true" value="{{$task->doc_url}}">
												</div>
												<div class="form-group">
													<label for="description">Descripción:</label>
													<input type="text" class="form-control" name="description" value="{{$task->doc_description}}">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
												<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="documentSubmit(this.form);">Salvar cambios</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
						<!-- End Modal Document URL -->
					@endif
					<form action="/form/submit" method="post" id="taskForm_{{$task->id}}">
						{{ csrf_field() }}
						<input type="hidden" name="formType" value="taskInfo">
						<input type="hidden" name="taskId" value="{{$task->id}}">
						<!-- Task Fields -->
						<div class="row margin-top">
							<div class="{{ $task->is_sub_task=='2'?'col-10 offset-1':'col-9 offset-2'}}">
								<div class="row task-data margin-top">
									<div class="col-6">
										<div class="row">
											<div class="col-4 title-single-data">Usuario requerido</div>
											<div class="col-6">
												<div class="input-responsible input-group responsible">
													<!-- Autocomplete for Responsible Search -->
													<select class="js-example-basic-single" name="responsibleId" style="width:100%; line-height: 1.5; min-width: 250px;" {{($taskEditAllowed || $task->has_role_exception==1)?'onchange="dataSubmit(this.form,false,null);"':'disabled'}}>
														<option></option>
														@foreach($responsibles_list[$task->id] as $resp)

															@if( ($task->cms_users_id!='' && $resp->id==$task->cms_users_id)
																	|| ($task->cms_users_id=='' && $resp->id==$task->default_users_id) )
																<option selected value="{{$resp->id}}">{{$resp->name}}</option>
															@else
																<option value="{{$resp->id}}">{{$resp->name}}</option>
															@endif
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-12 title-single-data">Documento</div>
										</div>
									</div>
								</div>
								<!---->
								<div class="row task-data">
									<div class="col-6 title-single-data">
									</div>
									<div class="col-6 title-single-data">
										@if($task->doc_url != null)
											<div class="blueicon" id="taskDocUploadId_{{$task->id}}">
												<div class="upload-icon" {{($taskEditAllowed || $task->has_role_exception==1)?'data-toggle=modal data-target=#docUrlModal_'.$task->id :'style=cursor:no-drop;'}} title="Upload Document"></div>
											</div>
											<div class="blueicon" id="taskDocDownloadId_{{$task->id}}" >
												@if ($taskEditAllowed || $task->has_role_exception==1)
													<div class="download-icon" title="Download Document" onclick="downloadFromSharepoint('/downloadDoc/{{$projectId}}/taskDocUrl/{{$task->id}}/{{htmlentities($task->doc_url)}}')"></div>
												@else
													<div class="download-icon" title="Download Document" style="cursor:no-drop"></div>
												@endif
											</div>
											<span id="taskDocDescId_{{$task->id}}" class="fieldValue">{{$task->doc_description}}</span>
										@else
											<div class="blueicon disabled" id="taskDocUploadId_{{$task->id}}">
												<div class="upload-icon" {{($taskEditAllowed || $task->has_role_exception==1)?'data-toggle=modal data-target=#docUrlModal_'.$task->id:''}} title="Upload Document"></div>
											</div>
											<div class="blueicon disabled" id="taskDocDownloadId_{{$task->id}}">
												<div class="download-icon" title="Download Document"></div>
											</div>
											<span class="disabled fieldValue" id="taskDocDescId_{{$task->id}}">Documento no disponible</span>
										@endif

									</div>
								</div>
								<!---->
								<!--consultado-->
								<div class="row task-data margin-top2 consultedContainer" data-taskId="{{$task->id}}">
									<div class="col-6">
										<div class="row">
											<div class="col-4 title-single-data">Usuario consultado</div>
											<div class="col-6">
												<div class="input-consulted input-group consulted">
													<select id="consulted_user_taskForm_{{$task->id}}" class="childList "
														name="consulted_user"
														style="width:100%; line-height: 1.5; min-width: 250px;"
														data-placeHolder="Buscar por nombre o email"
														aria-hidden="true"
														{{($taskEditAllowed || $task->has_role_exception==1)?'onchange="dataSubmit(this.form,false,null);"':'disabled'}}>
														<option selected value="{{$task->consultable_user_email}}">{{$task->consultable_user_name}}</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!---->
								<div class="row task-data margin-top2">
									<div class="col-6">
										<div class="row">
											<div class="col-12 title-single-data">Fecha limite:
												<span class="fieldValue"  id="taskDateField_{{$task->id}}">{{$task->duedate!=null?date('d/m/Y', strtotime($task->duedate)):'dd/mm/yyyy'}}</span>
												<span id='datetimepicker_{{$task->id}}'>
													<input type='hidden' id="taskDate_{{$task->id}}" name="deadline" class="form-control" value="{{$task->duedate!=null?date('d/m/Y', strtotime($task->duedate)):''}}"/>
													<span class="">
														<span class="approval-calendar glyphicon glyphicon-calendar"></span>
													</span>
												</span>
												<script type="text/javascript">
													$(function () {
														$('#datetimepicker_{{$task->id}}').datepicker({
															autoclose: true,
															format: "dd/mm/yyyy",
															clearBtn: true
														});
														$('#taskDate_{{$task->id}}').change(function () {
															taskDate=$(this).val();
															if(taskDate==''){
																taskDate='dd/mm/yyyy';
															}
															$('#taskDateField_{{$task->id}}').text(taskDate);
															dataSubmit(this.form, false, null);
														});
														$('#datetimepicker_{{$task->id}}').datepicker().on('clearDate', function (ev) {
															$('#taskDate_{{$task->id}}').val(null).trigger("change");
														});
													});
												</script>
											</div>
										</div>
									</div>
									<div class="col-6">
										<div class="row">
											<div class="col-12 title-single-data">Completado:
												<span class="fieldValue taskDate">{{$task->completion_date!=''?date('d/m/Y', strtotime($task->completion_date)):''}}</span>
											</div>
										</div>
									</div>
								</div>
								<!---->
							</div>
							<!-- Section Approval -->
							<div class="col-1 task-swich align-self-center">
								<div class="switch-container-2">
									<div class="circle-na {{ $task->status_id=='5' ? 'active' : '' }}">
										<span>N/A</span>
									</div>
									<div class="circle-done {{ $task->status_id=='4' ? 'active' : '' }}">
										<span>Done</span>
									</div>
									<input type="hidden" name="na_" 		value="{{ $task->status_id=='5' ? '1' : '0' }}" />
									<input type="hidden" data-parent="{{$parentTask}}" name="done_" 		value="{{ $task->status_id=='4' ? '1' : '0' }}" />
									<!--input type="hidden" name="oldStatusId" value="{{$task->status_id}}" /-->
								</div>
							</div>
						</div><!-- Task Fields -->
						<div class="row task-data comment margin-top2">
							<div class="comment-button col-1 {{ $task->is_sub_task=='0'?'offset-1':'offset-2'}}">
								<span>Comentario</span>
							</div>
							<div class="comment-area form-group {{ $task->is_sub_task=='0'?'col-10':'col-9'}}">
								<textarea class="form-control" {{($taskEditAllowed || $task->has_role_exception==1)?'onchange=dataSubmit(this.form,false,null)':'disabled'}}  name="comment" id="commentTextarea" rows="3" placeholder="Por favor, introduzca comentarios relevantes (max. 250 caracteres)...">{{($taskEditAllowed || $task->has_role_exception==1) ? $task->comment : ""}}</textarea>
							</div>
						</div>
					</form>
				</div><!-- Task Body -->
			@endif
		</div><!-- END Task -->
	@endforeach
	@if($taskNumber>0)
	<!-- GRAY SECTION SEPARATOR -->
	<div class="section-separator" ></div>
	@endif
</div>
<form id="consulted_form" action="/form/saveConsulted" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="hidden" name="consulted_taskId" value="">
	<input type="hidden" name="consulted_name" value="">
	<input type="hidden" name="consulted_email" value="">
</form>
