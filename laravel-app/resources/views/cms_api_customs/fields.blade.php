<!-- Permalink Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permalink', 'Permalink:') !!}
    {!! Form::text('permalink', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Tabel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tabel', 'Tabel:') !!}
    {!! Form::text('tabel', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Aksi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aksi', 'Aksi:') !!}
    {!! Form::text('aksi', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Kolom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kolom', 'Kolom:') !!}
    {!! Form::text('kolom', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Orderby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('orderby', 'Orderby:') !!}
    {!! Form::text('orderby', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Sub Query 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_query_1', 'Sub Query 1:') !!}
    {!! Form::text('sub_query_1', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Sql Where Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sql_where', 'Sql Where:') !!}
    {!! Form::text('sql_where', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Parameter Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parameter', 'Parameter:') !!}
    {!! Form::text('parameter', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
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

<!-- Method Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('method_type', 'Method Type:') !!}
    {!! Form::text('method_type', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25]) !!}
</div>

<!-- Parameters Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('parameters', 'Parameters:') !!}
    {!! Form::textarea('parameters', null, ['class' => 'form-control']) !!}
</div>

<!-- Responses Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('responses', 'Responses:') !!}
    {!! Form::textarea('responses', null, ['class' => 'form-control']) !!}
</div>