<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Input Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content_input_type', 'Content Input Type:') !!}
    {!! Form::text('content_input_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Dataenum Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dataenum', 'Dataenum:') !!}
    {!! Form::text('dataenum', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Helper Field -->
<div class="form-group col-sm-6">
    {!! Form::label('helper', 'Helper:') !!}
    {!! Form::text('helper', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
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

<!-- Group Setting Field -->
<div class="form-group col-sm-6">
    {!! Form::label('group_setting', 'Group Setting:') !!}
    {!! Form::text('group_setting', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Label:') !!}
    {!! Form::text('label', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>