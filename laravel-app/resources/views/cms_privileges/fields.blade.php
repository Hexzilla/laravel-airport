<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Is Superadmin Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_superadmin', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_superadmin', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_superadmin', 'Is Superadmin', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Theme Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('theme_color', 'Theme Color:') !!}
    {!! Form::text('theme_color', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::text('created_at', null, ['class' => 'form-control','id'=>'created_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#created_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::text('updated_at', null, ['class' => 'form-control','id'=>'updated_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#updated_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Is App Role Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_app_role', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_app_role', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_app_role', 'Is App Role', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Project Role Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_project_role', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_project_role', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_project_role', 'Is Project Role', ['class' => 'form-check-label']) !!}
    </div>
</div>
