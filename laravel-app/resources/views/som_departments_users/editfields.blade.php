<!-- Som Departments Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('som_departments_id', 'Som Departments Id:') !!}
    {!! Form::number('som_departments_id', null, ['class' => 'form-control']) !!}
</div> -->
<!-- <input type="hidden" name="som_departments_id" id="som_departments_id" value="{!! $som_departments_id !!}"> -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_departments_id', 'Department') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_departments_id', $data['departments'], $data['selected_department_id'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Cms Users Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('cms_users_id', 'Users') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('cms_users_id', $data['users'], $data['selected_user'], ['class' => 'select2 form-control']) !!}
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
});
</script>