<!-- Som Project Id Field -->
{{ Form::hidden('som_project_id', $somProjectsId) }} 

<!-- Som Edited Id Field -->
{{ Form::hidden('som_project_additional_airporty_id', $somEditId) }} 

<!-- Som Airport Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_airport_id', 'Airport') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_airport_id', $somProjectsAirports, $selectedItem, ['class' => 'form-control']) !!}
    </div>
</div>