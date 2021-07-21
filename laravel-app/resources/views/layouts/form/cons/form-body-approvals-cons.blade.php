<!-- SECTION 3: Approvals ***************************************************** -->
<div id="div-section-approvals" class="row section-title" style="margin-bottom:0px">
	<div class="col-12 div-section-title collapsed" data-toggle="collapse" data-target="#approval-element-list">
		<span>Aprobaciones</span>
	</div>
</div>
<!-- Approval Confirm-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="approval-confirm">
	<div class="vertical-alignment-helper">
		<div class="modal-dialog vertical-align-center">
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="" id="myModalLabel">Confirmar Aprobación</h4>
			</div>
			<div class="modal-body">
				<div style="margin-bottom:20px;">
					¿Deseas lanzar el proceso de aprobaciones?
				</div>
				<div style="font-size: 14px;">
					Advertencia: Asegúrate que tengas completadas todas las tareas y elementos de control.
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="modal-btn-no">No</button>
				<button type="button" class="btn btn-primary" id="modal-btn-si">Yes</button>
			</div>
			</div>
		</div>
	</div>
</div>

<div id="approval-element-list" class="collapse">
	<!-- Approval List *************************************************** -->
	<div class="task-area approval">
		@foreach($approval_list as $index=>$approval)
			@if($approvalEditAllowed)
				<!-- Modal Document URL -->
				<form action="/form/submit" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="formType" value="approvalDocUrl">
					<input type="hidden" name="appRespId" value="{{$approval->approval_resp_id}}">
					<input type="hidden" name="id" value="{{$approval->id}}">
					<input type="hidden" name="projectId" value="{{$projectId}}">
					<div class="modal fade" id="approvDocUrlModal_{{$approval->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="vertical-alignment-helper">
						<div class="modal-dialog vertical-align-center">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" style="" id="myModalLabel">Documento</h4>
								</div>
								<div class="modal-body">
									<label for="doc1">Documento:</label>
									<div class="input-group" style="margin-bottom: 1rem; {{$approval->document!=''?'':'display:none;'}}">
										<span class="input-group-btn">
											<button class="btn btn-secondary" style="font-weight: bold;" type="button" onclick="removeFileDoc('approvDocUrl',{{$approval->id}})">Remove file</button>
										</span>
										<input type="text" class="form-control" name="originalDoc" readonly value="{{$approval->document}}">
									</div>
									<div class="form-group" style="{{$approval->document!=''?'display:none;':''}}">
										<input type="file" class="form-control filestyle" name="doc" data-buttonBefore="true" value="{{$approval->document}}">
									</div>
									<div class="form-group">
										<label for="description">Descripción:</label>
										<input type="text" class="form-control" name="description" value="{{$approval->doc_description}}">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="documentSubmit(this.form);">Salvar cambios</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>
				<!-- End Modal Document URL -->
			@endif

			<!-- Approval *************************************************** -->
			<form action="/form/submit" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="formType" value="approvalInfo">
				<input type="hidden" name="appRespId" value="{{$approval->approval_resp_id}}">
				<input type="hidden" name="formId" value="{{$formId}}">
				<input type="hidden" name="id" value="{{$approval->id}}">
				<div class="task-area approvalHeader" id="approval_{{$approval->id}}">
					<div class="row task-header approvalTitle collapsed" data-toggle="collapse" data-target="#appBody_{{$approval->id}}">
						<div class="col-6 offset-1">
							<div class="row">
								<div class="col-12 task-description">Responsable:
									<span class="responsive fieldValue" style="display: inline;">{{$approval->name}}</span>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="row">

							</div>
						</div>
						<div class="col-1 indicator align-self-center">
							<span></span>
						</div>
					</div>
					<!---->
					<div id="appBody_{{$approval->id}}" class="collapse">
						<div class="row task-area">
							<div class="col-10 offset-1 align-self-center">
								<div class="row task-data">
									<div class="col-6">
										<div class="row">
											<div class="col-12 title-single-data">Fecha:
												<span class="taskDate fieldValue" id="approvalDateField_{{$approval->id}}">
													{{ $approval->lastupdate!=''?date('d/m/Y', strtotime($approval->lastupdate)):''}}
												</span>
												@if($approval->lastupdate!='' && $approvalEditAllowed)
													<span id='datetimepicker_{{$approval->id}}'>
														<input type='hidden' id="approvalDate_{{$approval->id}}" name="approvalDate" class="form-control" value="{{ $approval->lastupdate!=''?date('d/m/Y', strtotime($approval->lastupdate)):''}}"/>
															<span class="">
																<span class="approval-calendar glyphicon glyphicon-calendar"></span>
															</span>
													</span>
													<script type="text/javascript">
														$(function () {
															$('#datetimepicker_{{$approval->id}}').datepicker({
																autoclose: true,
																format: "dd/mm/yyyy"
															});
															$('#approvalDate_{{$approval->id}}').change(function () {
																$('#approvalDateField_{{$approval->id}}').text($(this).val());
																dataSubmit(this.form, false, null);
															});
														});
													</script>
												@endif
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
									<div class="col-6">
									</div>
									<div class="col-6">
										@if($approval->document != null)
											<div class="blueicon" id="approvalDocUploadId_{{$approval->id}}">
											<div class="upload-icon" {{$approvalEditAllowed?'data-toggle=modal data-target=#approvDocUrlModal_'.$approval->id:'style=cursor:no-drop;'}} title="Upload Document"></div>
											</div>
											<div class="blueicon" id="approvalDocDownloadId_{{$approval->id}}">
												@if ($approvalEditAllowed)
													<div class="download-icon" title="Download Document" onclick="downloadFromSharepoint('/downloadDoc/{{$projectId}}/approvalDocUrl/{{$approval->id}}/{{htmlentities($approval->document)}}')"></div>
												@else
													<div class="download-icon" title="Download Document" style="cursor:no-drop"></div>
												@endif
											</div>
											<span id="approvalDocDescId_{{$approval->id}}">{{$approval->doc_description}}</span>
										@else
											<div class="blueicon disabled" id="approvalDocUploadId_{{$approval->id}}">
												<div class="upload-icon" {{$approvalEditAllowed?'data-toggle=modal data-target=#approvDocUrlModal_'.$approval->id:''}} title="Upload Document"></div>
											</div>
											<div class="blueicon disabled" id="approvalDocDownloadId_{{$approval->id}}">
												<div class="download-icon" title="Download Document"></div>
											</div>
											<span class="disabled" id="approvalDocDescId_{{$approval->id}}">Documento no disponible</span>
										@endif
									</div>
								</div>
								<!---->
							</div>
							<!-- Approval Switch -->
							<div class="col-1 task-data task-swich align-self-center">
								<div class="switch-container-{{count($approval_status_list[$approval->id])}}">
									@foreach($approval_status_list[$approval->id] as $index => $status)
										@if( ($status->name) == "Done")
											<div title="{{$status->name}}" class="circle-ok {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
												<span>
													<i class="fa fa-check" aria-hidden="true"></i>
												</span>
											</div>
											<input type="hidden" name="ok_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
										@elseif( ($status->name) == "Review" )
											<div title="{{$status->name}}" class="circle-review {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
												<span>R</span>
											</div>
											<input type="hidden" name="review_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
										@elseif( ($status->name) == "Rejected" )
											<div title="{{$status->name}}" class="circle-cancel {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
												<span>
													<i class="fa fa-times" aria-hidden="true"></i>
												</span>
											</div>
											<input type="hidden" name="cancel_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
										@else
											<div title="{{$status->name}}" class="circle-na approval {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
												<span>N/A</span>
											</div>
											<input type="hidden" name="na_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
										@endif
									@endforeach
									<!--input type="hidden" name="oldStatusId" value="{{$status->status_id}}"/-->
								</div>
							</div>
							<!-- End Approval Switch -->
						</div>
						<!-- Comments Row -->
						<div class="row task-data comment">
							<div class="col-1 offset-1 comment-button">
								<span>Comentario</span>
							</div>
							<div class="col-10 comment-area form-group">
								<textarea class="form-control" {{$approvalEditAllowed?'onchange=dataSubmit(this.form,false,null)':'disabled'}} name="comment"  id="commentTextarea" rows="3" placeholder="Please introduce relevant comments (max. 250 characters)...">{{$approval->comment}}</textarea>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-11 offset-1 approvalDiv">
						<div class="{{$approval != end($approval_list)?'endline':'endline-transparent'}}" style="padding-top: 0em;"></div>
					</div>
					<!--Esta linea al final de cada approval-->
				</div>
				<!-- END Approval -->
			</form>

		@endforeach
	</div>
</div>