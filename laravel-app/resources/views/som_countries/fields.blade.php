<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Country Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_code', 'Country Code:') !!}
    {!! Form::text('country_code', null, ['class' => 'form-control','maxlength' => 2,'maxlength' => 2]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<!-- Politics Field -->
<div class="form-group col-sm-6">
    {!! Form::label('politics', 'Politics:') !!}
    {!! Form::number('politics', null, ['class' => 'form-control']) !!}
</div>

<!-- Regulatory Field -->
<div class="form-group col-sm-6">
    {!! Form::label('regulatory', 'Regulatory:') !!}
    {!! Form::number('regulatory', null, ['class' => 'form-control']) !!}
</div>

<!-- Corruption Field -->
<div class="form-group col-sm-6">
    {!! Form::label('corruption', 'Corruption:') !!}
    {!! Form::number('corruption', null, ['class' => 'form-control']) !!}
</div>

<!-- Business Easyness Field -->
<div class="form-group col-sm-6">
    {!! Form::label('business_easyness', 'Business Easyness:') !!}
    {!! Form::number('business_easyness', null, ['class' => 'form-control']) !!}
</div>

<!-- Spain Affinity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('spain_affinity', 'Spain Affinity:') !!}
    {!! Form::number('spain_affinity', null, ['class' => 'form-control']) !!}
</div>

<!-- Aena Strategy Align Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aena_strategy_align', 'Aena Strategy Align:') !!}
    {!! Form::text('aena_strategy_align', null, ['class' => 'form-control','maxlength' => 3,'maxlength' => 3]) !!}
</div>

<!-- Tourism Activity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tourism_activity', 'Tourism Activity:') !!}
    {!! Form::number('tourism_activity', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Risk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_risk', 'Country Risk:') !!}
    {!! Form::text('country_risk', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
</div>

<!-- Imports Exports Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imports_exports', 'Imports Exports:') !!}
    {!! Form::number('imports_exports', null, ['class' => 'form-control']) !!}
</div>

<!-- Version Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version_date', 'Version Date:') !!}
    {!! Form::text('version_date', null, ['class' => 'form-control','id'=>'version_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#version_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Exchange Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('exchange_rate', 'Exchange Rate:') !!}
    {!! Form::text('exchange_rate', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>