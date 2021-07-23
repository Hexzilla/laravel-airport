<!-- SECTION 2: Elements of control ******************************************* -->
<div id="div-section-elements" class="row section-title" >
	<div class="col-12 div-section-title collapsed" data-toggle="collapse" data-target="#control-element-list">
		<span>Elementos de Control</span>
	</div>
</div>
<div id="control-element-list" class="collapse">
	@php
		$elementNumber=0;
		$parentElement=0;
	@endphp
	@foreach($element_list as $element)
		@if($element->is_sub_element!="0")
			@if($elementEditAllowed || $element->has_role_exception==1)
				<form action="/form/submit" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="formType" value="elementDocUrl">
					<input type="hidden" name="elementId" value="{{$element->id}}">
					<input type="hidden" name="id" value="{{$element->id}}">
					<input type="hidden" name="projectId" value="{{$projectId}}">
					<!-- Modal Document URL -->
					<div class="modal fade modalDocElement" id="eleDocUrlModal_{{$element->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="vertical-alignment-helper">
							<div class="modal-dialog vertical-align-center">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" style="" id="myModalLabel">Document</h4>
									</div>
									<div class="modal-body">
										<label for="doc1">Documento:</label>
										<div class="input-group" style="margin-bottom: 1rem; {{$element->doc_url!=''?'':'display:none;'}}">
											<span class="input-group-btn">
												<button class="btn btn-secondary" style="font-weight: bold;" type="button" onclick="removeFileDoc('eleDocUrl',{{$element->id}})">Remove file</button>
											</span>
											<input type="text" class="form-control" name="originalDoc" readonly value="{{$element->doc_url}}">
										</div>
										<div class="form-group" style="{{$element->doc_url!=''?'display:none;':''}}">
											<input type="file" class="form-control filestyle" name="doc" data-buttonBefore="true" value="{{$element->doc_url}}">
										</div>
										<div class="form-group">
											<label for="description">Descripción:</label>
											<input type="text" class="form-control" name="description" value="{{$element->doc_description}}">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="documentSubmit(this.form, true);">Save changes</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- End Modal Document URL -->
				<!-- Modal Template URL -->
				<form action="/form/submit" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="formType" value="elementTemplateUrl">
					<input type="hidden" name="elementId" value="{{$element->id}}">
					<input type="hidden" name="id" value="{{$element->id}}">
					<input type="hidden" name="projectId" value="{{$projectId}}">
					<div class="modal fade" id="tempDocUrlModal_{{$element->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="vertical-alignment-helper">
							<div class="modal-dialog vertical-align-center">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" style="" id="myModalLabel">Plantilla</h4>
									</div>
									<div class="modal-body">
										<label for="doc1">Documento:</label>
										<div class="input-group" style="margin-bottom: 1rem; {{$element->template!=''?'':'display:none;'}}">
											<span class="input-group-btn">
												<button class="btn btn-secondary" style="font-weight: bold;" type="button" onclick="removeFileDoc('tempDocUrl',{{$element->id}})">Remove file</button>
											</span>
											<input type="text" class="form-control" name="originalDoc" readonly value="{{$element->template}}">
										</div>
										<div class="form-group" style="{{$element->template!=''?'display:none;':''}}">
											<input type="file" class="form-control filestyle" name="doc" data-buttonBefore="true" value="{{$element->template}}">
										</div>
										<div class="form-group">
											<label for="description">Descripcion:</label>
											<input type="text" class="form-control" name="description" value="{{$element->template_description}}">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="documentSubmit(this.form, true);">Salvar cambios</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- End Modal Template URL -->
			@endif
		@else
			@php
				$parentElement=$element->id;
			@endphp
		@endif
			<!-- Element of control *************************************************** -->
			<form action="/form/submit" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="formType" value="elementInfo">
				<input type="hidden" name="elementId" value="{{$element->id}}">
					@if($element->is_sub_element!="0")
						@if($element->is_sub_element=="1")
							<div  class="task-area elements eleBody_{{$parentElement}} collapse" style="padding-bottom:0px;">
						@elseif	($element->is_sub_element=="2")
							<div  class="task-area elements" style="padding-bottom:0px;">
						@endif
						<!-- Header -->
							<div class="row task-header collapsed" data-toggle="collapse" data-target="#eleBody_{{$element->id}}">
								<div class="task-description {{ $element->is_sub_element=="2"?'col-10 offset-1':'col-9 offset-2'}}">
									<span>{{$element->name}}
										<i class="fa fa-info-circle tooltip-task-info" data-toggle="tooltip" data-placement="top" style="{{$element->tooltip!=''?'':'display:none;'}}" title="{{$element->tooltip}}"></i>
										<i class="mandatory-field" style="{{$element->role_name_and_mandatory != ''?'':'display:none;'}}">{{$element->role_name_and_mandatory}}</i>
									</span>
									<span class="last-update">Ultima Actualización:
										<span class="date">{{$element->lastupdate!=''?date('d/m/Y', strtotime($element->lastupdate)):''}}</span>
									</span>
								</div>
								<div class="col-1 indicator align-self-center">
									<span></span>
								</div>
							</div>
							<!-- End Header -->
							<!-- Body -->
							<div id="eleBody_{{$element->id}}" class="collapse">
								<div class="row">
									<div class="{{ $element->is_sub_element=="2"?'col-10 offset-1':'col-9 offset-2'}}">
										<div class="row task-data margin-top2">
											<div class="col-6">
												<div class="row">
													<div class="col-12 title-single-data">Documento</div>
												</div>
											</div>
											<div class="col-6">
												<div class="row">
													<div class="col-12 title-single-data">Plantilla</div>
												</div>
											</div>
										</div>
										<!---->
										<div class="row task-data">
											<div class="col-6">
												@if($element->doc_url != null)
													<div class="blueicon {{$element->is_mandatory?'obligatorio':''}}" id="eleDocUploadId_{{$element->id}}">
														<div class="upload-icon" {{($elementEditAllowed || $element->has_role_exception==1)?'data-toggle=modal data-target=#eleDocUrlModal_'.$element->id:'style=cursor:no-drop;'}} title="Upload Document"></div>
													</div>
													<div class="blueicon" id="eleDocDownloadId_{{$element->id}}">
														@if ($elementEditAllowed || $element->has_role_exception==1)
															<div class="download-icon cc" title="Download Document" onclick="downloadFromSharepoint('/downloadDoc/{{$projectId}}/elementDocUrl/{{$element->id}}/{{htmlentities($element->doc_url)}}')"></div>
														@else
															<div class="download-icon cc" title="Download Document" style="cursor:no-drop"></div>
														@endif
													</div>
													<span id="eleDocDescId_{{$element->id}}">{{$element->doc_description}}</span>
												@else
													<div class="blueicon disabled {{$element->is_mandatory?'obligatorio':''}}" id="eleDocUploadId_{{$element->id}}">
														<div class="upload-icon" {{($elementEditAllowed || $element->has_role_exception==1)?'data-toggle=modal data-target=#eleDocUrlModal_'.$element->id:''}} title="Upload Document"></div>
													</div>
													<div class="blueicon disabled" id="eleDocDownloadId_{{$element->id}}">
														<div class="download-icon" title="Download Document URL"></div>
													</div>
													<span class="disabled" id="eleDocDescId_{{$element->id}}">Documento no disponible</span>
												@endif
											</div>
											<div class="col-6">
												@if($element->template != null)
													<div class="blueicon" id="eleTempUploadId_{{$element->id}}">
														<div class="upload-icon" {{($elementEditAllowed || $element->has_role_exception==1)?'data-toggle=modal data-target=#tempDocUrlModal_'.$element->id:'style=cursor:no-drop;'}} title="Upload Template"></div>
													</div>
													<div class="blueicon" id="eleTempDownloadId_{{$element->id}}">

														@if ($elementEditAllowed || $element->has_role_exception==1)
															<div class="download-icon" title="Download Template" onclick="downloadFromSharepoint('/downloadDoc/{{$projectId}}/elementTemplateUrl/{{$element->id}}/{{htmlentities($element->template)}}')"></div>
														@else
															<div class="download-icon" title="Download Template" style="cursor:no-drop"></div>
														@endif
													</div>
													<span id="eleTempDescId_{{$element->id}}">{{$element->template_description}}</span>
												@else
													<div class="blueicon disabled" id="eleTempUploadId_{{$element->id}}">
														<div class="upload-icon" {{($elementEditAllowed || $element->has_role_exception==1)?'data-toggle=modal data-target=#tempDocUrlModal_'.$element->id:''}}  title="Upload Template"></div>
													</div>
													<div class="blueicon disabled" id="eleTempDownloadId_{{$element->id}}">
														<div class="download-icon" title="Download Template"></div>
													</div>
													<span class="disabled" id="eleTempDescId_{{$element->id}}">Documento no disponible</span>
												@endif
											</div>
										</div>
									</div>
								</div>
								<!-- Comments Row -->
								<div class="row task-data comment margin-top2">
									<div class="comment-button col-1 {{ $element->is_sub_element=="0"?'offset-1':'offset-2'}}">
										<span>Comentario</span>
									</div>
									<div class="comment-area form-group {{ $element->is_sub_element=="0"?'col-10':'col-9'}}">
										<textarea class="form-control" {{($elementEditAllowed || $element->has_role_exception==1)?'onchange=dataSubmit(this.form,false,null)':'disabled'}} name="comment" id="commentTextarea" rows="3" placeholder="Please introduce relevant comments (max. 250 characters)...">{{($elementEditAllowed || $element->has_role_exception==1) ? $element->comment : ''}}</textarea>
									</div>
								</div>
							</div>
							<!-- End Body -->
							<div class="row">
								<div class="elementDiv col-11 offset-1">
									<div class="{{$element != end($element_list)?'endline':'endline-transparent'}}"></div>
								</div>
								<!--Esta linea al final de cada approval-->
							</div>
						</div>
					@else
						<div  class="task-area elements" style="padding-bottom:0px;">
							<!-- Header -->
							<div class="row task-header collapsed" data-toggle="collapse" data-target=".eleBody_{{$element->id}}">
								<div class="task-description {{ $element->is_sub_element=="0"?'col-10 offset-1':'col-9 offset-2'}}">
									<span>{{$element->name}}
										<i class="fa fa-info-circle tooltip-task-info" data-toggle="tooltip" data-placement="top" style="{{$element->tooltip!=''?'':'display:none;'}}" title="{{$element->tooltip}}"></i>
										<i class="mandatory-field" style="{{$element->role_name_and_mandatory != ''?'':'display:none;'}}">{{$element->role_name_and_mandatory}}</i>
									</span>
									<span class="last-update">Ultima Actualización:
										<span class="date">{{$element->lastupdate!=''?date('d/m/Y', strtotime($element->lastupdate)):''}}</span>
									</span>
								</div>
								<div class="col-1 indicator align-self-center">
									<span></span>
								</div>
							</div>
							<!-- End Header -->
						</div>
					@endif
			<!-- END Element of control-->
			</form>
	@endforeach
	@if(@$nElements > 0)
	<!-- GRAY SECTION SEPARATOR -->
<div class="section-separator" > </div>
	@endif

</div>