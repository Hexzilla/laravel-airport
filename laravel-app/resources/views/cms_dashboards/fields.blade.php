<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Id Cms Privileges Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('id_cms_privileges', 'Id Cms Privileges') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('id_cms_privileges', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Content Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('content', 'Content') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Created At Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('created_at', 'Created At') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('created_at', null, ['class' => 'form-control','id'=>'created_at']) !!}
    </div>
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
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('updated_at', 'Updated At') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('updated_at', null, ['class' => 'form-control','id'=>'updated_at']) !!}
    </div>
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