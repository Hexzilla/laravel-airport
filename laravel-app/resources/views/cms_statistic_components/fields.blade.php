<!-- Id Cms Statistics Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_cms_statistics', 'Id Cms Statistics:') !!}
    {!! Form::number('id_cms_statistics', null, ['class' => 'form-control']) !!}
</div>

<!-- Componentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('componentID', 'Componentid:') !!}
    {!! Form::text('componentID', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Component Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('component_name', 'Component Name:') !!}
    {!! Form::text('component_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Area Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('area_name', 'Area Name:') !!}
    {!! Form::text('area_name', null, ['class' => 'form-control','maxlength' => 55,'maxlength' => 55]) !!}
</div>

<!-- Sorting Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sorting', 'Sorting:') !!}
    {!! Form::number('sorting', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Config Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('config', 'Config:') !!}
    {!! Form::textarea('config', null, ['class' => 'form-control']) !!}
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