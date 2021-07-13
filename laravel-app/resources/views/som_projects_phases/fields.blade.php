<!-- Som Projects Id Field -->
{{ Form::hidden('som_projects_id', $projectId) }}

<!-- Som Edited Id Field -->
{{ Form::hidden('som_projects_phases_id', $som_projects_phases_id) }}

<!-- Som Phases Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_phases_id', 'Phase') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_phases_id', $somPhaseArray, $selectedPhaseItem['som_phases_id'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Som Order Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Order') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Som Status Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_status_id', 'Status') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_status_id',$somStatusArray, $selectedPhaseItem['som_status_id'], ['class' => 'form-control']) !!}
    </div>
</div>