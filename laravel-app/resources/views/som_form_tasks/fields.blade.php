<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<!-- Duedate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duedate', 'Duedate:') !!}
    {!! Form::text('duedate', null, ['class' => 'form-control','id'=>'duedate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#duedate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Task Completion Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('task_completion_date', 'Task Completion Date:') !!}
    {!! Form::text('task_completion_date', null, ['class' => 'form-control','id'=>'task_completion_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#task_completion_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Request Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('request_date', 'Request Date:') !!}
    {!! Form::text('request_date', null, ['class' => 'form-control','id'=>'request_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#request_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Tooltip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tooltip', 'Tooltip:') !!}
    {!! Form::text('tooltip', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
</div>

<!-- Support Doc Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('support_doc_url', 'Support Doc Url:') !!}
    {!! Form::text('support_doc_url', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Support Doc Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('support_doc_description', 'Support Doc Description:') !!}
    {!! Form::text('support_doc_description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_status_id', 'Som Status Id:') !!}
    {!! Form::number('som_status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Forms Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_forms_id', 'Som Forms Id:') !!}
    {!! Form::number('som_forms_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Departments Users Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_departments_users_id', 'Som Departments Users Id:') !!}
    {!! Form::number('som_departments_users_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Departments Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_departments_id', 'Som Departments Id:') !!}
    {!! Form::number('som_departments_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Sub Task Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_sub_task', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_sub_task', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_sub_task', 'Is Sub Task', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Cms Users Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_users_id', 'Cms Users Id:') !!}
    {!! Form::number('cms_users_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cms Privileges Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_privileges_role_id', 'Cms Privileges Role Id:') !!}
    {!! Form::number('cms_privileges_role_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Consultable User Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('consultable_user_name', 'Consultable User Name:') !!}
    {!! Form::text('consultable_user_name', null, ['class' => 'form-control','maxlength' => 200,'maxlength' => 200]) !!}
</div>

<!-- Consultable User Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('consultable_user_email', 'Consultable User Email:') !!}
    {!! Form::text('consultable_user_email', null, ['class' => 'form-control','maxlength' => 200,'maxlength' => 200]) !!}
</div>