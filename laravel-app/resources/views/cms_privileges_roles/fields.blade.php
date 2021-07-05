<!-- Is Visible Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_visible', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_visible', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Create Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_create', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_create', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_create', 'Is Create', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Read Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_read', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_read', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_read', 'Is Read', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Edit Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_edit', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_edit', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_edit', 'Is Edit', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Delete Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_delete', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_delete', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_delete', 'Is Delete', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Id Cms Privileges Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_cms_privileges', 'Id Cms Privileges:') !!}
    {!! Form::number('id_cms_privileges', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Cms Moduls Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_cms_moduls', 'Id Cms Moduls:') !!}
    {!! Form::number('id_cms_moduls', null, ['class' => 'form-control']) !!}
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