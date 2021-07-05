<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 245,'maxlength' => 245]) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 245,'maxlength' => 245]) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', 'Lat:') !!}
    {!! Form::number('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- Long Field -->
<div class="form-group col-sm-6">
    {!! Form::label('long', 'Long:') !!}
    {!! Form::number('long', null, ['class' => 'form-control']) !!}
</div>

<!-- Iata Oaci Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iata_oaci', 'Iata Oaci:') !!}
    {!! Form::text('iata_oaci', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Som Projects Airport Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_projects_airport_type_id', 'Som Projects Airport Type Id:') !!}
    {!! Form::number('som_projects_airport_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', 'Size:') !!}
    {!! Form::number('size', null, ['class' => 'form-control']) !!}
</div>

<!-- Revenues Aeronautical Field -->
<div class="form-group col-sm-6">
    {!! Form::label('revenues_aeronautical', 'Revenues Aeronautical:') !!}
    {!! Form::number('revenues_aeronautical', null, ['class' => 'form-control']) !!}
</div>

<!-- Revenues Non Aeronautical Field -->
<div class="form-group col-sm-6">
    {!! Form::label('revenues_non_aeronautical', 'Revenues Non Aeronautical:') !!}
    {!! Form::number('revenues_non_aeronautical', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Revenues Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_revenues', 'Total Revenues:') !!}
    {!! Form::number('total_revenues', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Opex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_opex', 'Total Opex:') !!}
    {!! Form::number('total_opex', null, ['class' => 'form-control']) !!}
</div>

<!-- Ebitda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ebitda', 'Ebitda:') !!}
    {!! Form::number('ebitda', null, ['class' => 'form-control']) !!}
</div>

<!-- Kpi Revenues Aeronautical Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kpi_revenues_aeronautical', 'Kpi Revenues Aeronautical:') !!}
    {!! Form::number('kpi_revenues_aeronautical', null, ['class' => 'form-control']) !!}
</div>

<!-- Kpi Revenues Non Aeronautical Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kpi_revenues_non_aeronautical', 'Kpi Revenues Non Aeronautical:') !!}
    {!! Form::number('kpi_revenues_non_aeronautical', null, ['class' => 'form-control']) !!}
</div>

<!-- Kpi Ebitda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kpi_ebitda', 'Kpi Ebitda:') !!}
    {!! Form::number('kpi_ebitda', null, ['class' => 'form-control']) !!}
</div>

<!-- Percentage International Field -->
<div class="form-group col-sm-6">
    {!! Form::label('percentage_international', 'Percentage International:') !!}
    {!! Form::number('percentage_international', null, ['class' => 'form-control']) !!}
</div>

<!-- Percentage Transfer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('percentage_transfer', 'Percentage Transfer:') !!}
    {!! Form::number('percentage_transfer', null, ['class' => 'form-control']) !!}
</div>

<!-- Percentage Non Low Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('percentage_non_low_cost', 'Percentage Non Low Cost:') !!}
    {!! Form::number('percentage_non_low_cost', null, ['class' => 'form-control']) !!}
</div>

<!-- Infrastructure Characterization Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('infrastructure_characterization_description', 'Infrastructure Characterization Description:') !!}
    {!! Form::text('infrastructure_characterization_description', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Airport Catchment Area Field -->
<div class="form-group col-sm-6">
    {!! Form::label('airport_catchment_area', 'Airport Catchment Area:') !!}
    {!! Form::text('airport_catchment_area', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Competitors Field -->
<div class="form-group col-sm-6">
    {!! Form::label('competitors', 'Competitors:') !!}
    {!! Form::text('competitors', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Top1 Airline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('top1_airline', 'Top1 Airline:') !!}
    {!! Form::text('top1_airline', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Top2 Airline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('top2_airline', 'Top2 Airline:') !!}
    {!! Form::text('top2_airline', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Top3 Airline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('top3_airline', 'Top3 Airline:') !!}
    {!! Form::text('top3_airline', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
</div>

<!-- Top1 Airline Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('top1_airline_percentage', 'Top1 Airline Percentage:') !!}
    {!! Form::number('top1_airline_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Top2 Airline Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('top2_airline_percentage', 'Top2 Airline Percentage:') !!}
    {!! Form::number('top2_airline_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Top3 Airline Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('top3_airline_percentage', 'Top3 Airline Percentage:') !!}
    {!! Form::number('top3_airline_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Route Field -->
<div class="form-group col-sm-6">
    {!! Form::label('route', 'Route:') !!}
    {!! Form::text('route', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Master Plan Estimations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('master_plan_estimations', 'Master Plan Estimations:') !!}
    {!! Form::text('master_plan_estimations', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Society Model Regulation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('society_model_regulation', 'Society Model Regulation:') !!}
    {!! Form::text('society_model_regulation', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Aena Network Improvement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aena_network_improvement', 'Aena Network Improvement:') !!}
    {!! Form::text('aena_network_improvement', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Debt Ebitda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('debt_ebitda', 'Debt Ebitda:') !!}
    {!! Form::number('debt_ebitda', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img_url', 'Img Url:') !!}
    {!! Form::text('img_url', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Som Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_country_id', 'Som Country Id:') !!}
    {!! Form::number('som_country_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Other Info Field -->
<div class="form-group col-sm-6">
    {!! Form::label('other_info', 'Other Info:') !!}
    {!! Form::text('other_info', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Data Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_year', 'Data Year:') !!}
    {!! Form::number('data_year', null, ['class' => 'form-control']) !!}
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