<!-- Som Project Id Field -->
{{ Form::hidden('som_project_id', 'som_project_id') }}

<!-- Som Airport Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_airport_id', 'Airport') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('som_airport_id', null, ['class' => 'form-control']) !!}
    </div>
</div>