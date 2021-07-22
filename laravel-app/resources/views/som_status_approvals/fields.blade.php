<!-- Som Status Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_status_id', 'Som Status') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_status_id', $data['somStatuses'], $data['selected_status_id'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Som Approvals Responsible Id Field -->
<input type="hidden" name="som_approvals_responsible_id" id="som_approvals_responsible_id" value="{!! $som_approvals_responsible_id !!}">

<!-- Status Order Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('status_order', 'Status Order') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('status_order', null, ['class' => 'form-control']) !!}
    </div>
</div>

