<div class="row div-section-summary">
    <span class="main-title">Aprobaciones</span>
</div>
<div class="div-section-summary">
    @foreach($approval_list as $index => $approval)
		<div class="summary-approval row summary-row">
			<div style='display:inline' class="col-7 np">
				{{$approval->name}}
			</div>
			<div style='display:inline' class="col-3 np">
				<span class="approval-calendar glyphicon glyphicon-calendar" style="cursor:default"></span>
				<span class="date">{{$approval->lastupdate!=''?date('d/m/Y', strtotime($approval->lastupdate)):'--/--/--'}}</span>
			</div>
			<div class="col-1 np">
				<div id="shc_a_approval_{{$approval->id}}">
					@foreach($approval_status_list[$approval->id] as $status)
						@if( ($status->name) == "Done" && $approval->status_id==$status->status_id )
							<div style='display:inline-block; margin-top: 0px; ' title="{{$status->name}}" class="circle-ok {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
								<span style="line-height: 2;">
									<i class="fa fa-check" style="vertical-align: text-top;" aria-hidden="true"></i>
								</span>
							</div>
							<input type="hidden" name="ok_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
						@elseif( ($status->name) == "Review" && $approval->status_id==$status->status_id  )
							<div style='display:inline-block; margin-top: 0px;' title="{{$status->name}}" class="circle-review {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
								<span style="line-height: 2;font-size: 0.8em;">R</span>
							</div>
							<input type="hidden" name="review_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
						@elseif( ($status->name) == "Rejected" && $approval->status_id==$status->status_id  )
							<div style='display:inline-block; margin-top: 0px;' title="{{$status->name}}" class="circle-cancel {{ @$approval_status_active[$index]? '' : 'disabled' }} {{ $approval->status_id==$status->status_id ? 'active' : '' }}">
								<span style="line-height: 2;">
									<i class="fa fa-times" style="vertical-align: text-top;" aria-hidden="true"></i>
								</span>
							</div>
							<input type="hidden" name="cancel_" value="{{ $approval->status_id==$status->status_id ? '1' : '0' }}" />
						@endif
					@endforeach
				</div>
			</div>
		</div>	
	@endforeach
</div>