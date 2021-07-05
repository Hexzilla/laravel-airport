<!-- Som Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_country_id', 'Som Country Id:') !!}
    {!! Form::number('som_country_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Year:') !!}
    {!! Form::text('year', null, ['class' => 'form-control','id'=>'year']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#year').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Population Field -->
<div class="form-group col-sm-6">
    {!! Form::label('population', 'Population:') !!}
    {!! Form::number('population', null, ['class' => 'form-control']) !!}
</div>

<!-- Inflation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inflation', 'Inflation:') !!}
    {!! Form::number('inflation', null, ['class' => 'form-control']) !!}
</div>

<!-- Gpd Evolution Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gpd_evolution', 'Gpd Evolution:') !!}
    {!! Form::number('gpd_evolution', null, ['class' => 'form-control']) !!}
</div>