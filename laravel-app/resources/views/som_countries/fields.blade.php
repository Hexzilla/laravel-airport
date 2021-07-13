
<input type="hidden" name="id" id="id" value="{!! $data['id'] !!}">
<!-- Country Code Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country_code', 'Country Code:') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('country_code', null, ['class' => 'form-control','maxlength' => 2,'maxlength' => 2]) !!}
    </div>
</div>

<!-- Country Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country', 'Country:') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('country', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}        
    </div>
</div>

<!-- Description Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('description', 'Description:') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class' => 'form-control','rows' => 4, 'cols' => 50,'maxlength' => 500,'maxlength' => 500]) !!}
    </div>
</div>

<!-- Politics Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('politics', 'Politics:') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('politics', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Regulatory Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('regulatory', 'Regulatory:') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('regulatory', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Corruption Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('corruption', 'Corruption:') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('corruption', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Business Easyness Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('business_easyness', 'Easy of doing business') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('business_easyness', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Spain Affinity Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('spain_affinity', 'Afinity with Spain') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('spain_affinity', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Aena Strategy Align Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('aena_strategy_align', 'Location aligned with Aena international strategy') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('aena_strategy_align', null, ['class' => 'form-control','maxlength' => 3]) !!}
    </div>
</div>

<!-- Tourism Activity Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('tourism_activity', 'Tourism Situation (% PIB from tourism activity)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('tourism_activity', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Country Risk Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country_risk', 'Country Risk') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('country_risk', null, ['class' => 'form-control','maxlength' => 10]) !!}
    </div>
</div>

<!-- Imports Exports Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('imports_exports', 'Exports and imports (€ bn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('imports_exports', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Version Date Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('version_date', 'Version date') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('version_date', null, ['class' => 'form-control','id'=>'version_date']) !!}
    </div>
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
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('exchange_rate', 'Exchange rate') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('exchange_rate', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
    </div>
</div>