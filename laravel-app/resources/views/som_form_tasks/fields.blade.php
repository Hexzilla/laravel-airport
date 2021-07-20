{{ Form::hidden('som_forms_id', $somFormTasks->som_forms_id) }}
<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
    </div>
</div>

<!-- Order Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Order') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Tooltip Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('tooltip', 'Tooltip') !!}
        <span class="required">&nbsp;</span>
    </div>
    <div class="col-sm-10">
        {!! Form::textarea('tooltip', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
    </div>
</div>

<!-- Type Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('is_sub_task', 'Type') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('is_sub_task', $arrType, $somFormTasks->is_sub_task, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Role Assigned -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('cms_privileges_role_id', 'Role Assigned') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('cms_privileges_role_id', $arrRole, $somFormTasks->cms_privileges_role_id, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Department -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_departments_id', 'Department') !!}
        <span class="required">&nbsp;</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_departments_id', $arrDepart, $somFormTasks->som_departments_id, ['class' => 'form-control']) !!}
    </div>
</div>