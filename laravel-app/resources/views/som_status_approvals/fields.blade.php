<!-- Som Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_status_id', 'Som Status:') !!}
    <!-- {!! Form::number('som_status_id', null, ['class' => 'form-control']) !!} -->
     {!! Form::select('som_status_id', $data['somStatuses'], $data['selected_status_id'], ['class' => 'form-control']) !!}
</div>

<!-- Som Approvals Responsible Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('som_approvals_responsible_id', 'Som Approvals Responsible Id:') !!}
    {!! Form::number('som_approvals_responsible_id', null, ['class' => 'form-control']) !!}
</div> -->
<input type="hidden" name="som_approvals_responsible_id" id="som_approvals_responsible_id" value="{!! $som_approvals_responsible_id !!}">

<!-- Status Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_order', 'Status Order:') !!}
    {!! Form::number('status_order', null, ['class' => 'form-control']) !!}
</div>