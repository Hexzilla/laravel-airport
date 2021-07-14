<!-- Som Country Id Field -->
<input type="hidden" name="som_country_id" id="som_country_id" value="{!! $somCountry_id !!}">
<!-- Year Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('year', 'Year') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        <input class="form-control" id="year" name="year" type="text" value="{!! $data['selected_year'] !!}">
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#year').datetimepicker({
            // format: 'YYYY-MM-DD HH:mm:ss',
            format: 'YYYY',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Inflation Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('inflation', 'Inflation (%)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('inflation', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Population Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('population', 'Population (mn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('population', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Gpd Evolution Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('gpd_evolution', 'GDP (€ bn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('gpd_evolution', null, ['class' => 'form-control']) !!}
    </div>
</div>