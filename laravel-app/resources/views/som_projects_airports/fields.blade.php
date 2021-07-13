<style>
    #map-canvas{
        width: 468px;
        height: 350px;
    }
</style>

<input type="hidden" name="id" id="id" value="{!! $data['id'] !!}">
<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 245,'maxlength' => 245]) !!}
    </div>
</div>

<!-- Location Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('address', 'Location') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-8">
        {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 245,'maxlength' => 245]) !!}
    </div>
    <div class="col-sm-2">
        <a id="browse_map" class="btn btn-default" style="background-color:#009aff;color:#fff;float:right;">Browse Map</a>
    </div>
</div>

<!-- Country Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country', 'Country') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('country', $data['countries'], $data['selected_country'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Iata Oaci Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('iata_oaci', 'IATA/OACI code') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('iata_oaci', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
    </div>
</div>

<!-- Som Projects Airport Type Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_projects_airport_type_id', 'Type of airport') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_projects_airport_type_id', $data['airport_types'], $data['selected_airport'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Size (MPax) Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('size', 'Size (MPax)') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('size', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Revenues Aeronautical Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('revenues_aeronautical', 'Revenues Aeronautical (€ mn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('revenues_aeronautical', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Revenues Non Aeronautical Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('revenues_non_aeronautical', 'Revenues Non-aeronautical (€ mn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('revenues_non_aeronautical', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Total Revenues Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('total_revenues', 'Total revenues (€ mn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('total_revenues', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Total Opex Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('total_opex', 'Total Opex (€ mn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('total_opex', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Ebitda Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('ebitda', 'EBITDA (€ mn)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('ebitda', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Kpi Revenues Aeronautical Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('kpi_revenues_aeronautical', 'KPIS Revenues Aeronautical (€/pax)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('kpi_revenues_aeronautical', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Kpi Revenues Non Aeronautical Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('kpi_revenues_non_aeronautical', 'KPIS Revenues Non-aeronautical (€/pax)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('kpi_revenues_non_aeronautical', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Kpi Ebitda Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('kpi_ebitda', 'KPIS EBITDA/pax') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('kpi_ebitda', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Debt Ebitda Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('debt_ebitda', 'KPIS Debt/EBITDA') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('debt_ebitda', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Img Url Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('img_url', 'Aerial airport image') !!}
    </div>
    <div class="col-sm-10">
        <!-- {!! Form::text('img_url', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!} -->
        <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" id="chooseFile">
            <label class="custom-file-label" for="chooseFile">Select file</label>
        </div>
    </div>
</div>

<!-- Percentage International Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('percentage_international', '% international') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('percentage_international', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Percentage Transfer Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('percentage_transfer', '% transfer') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('percentage_transfer', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Percentage Non Low Cost Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('percentage_non_low_cost', '% Low cost') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('percentage_non_low_cost', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Infrastructure Characterization Description Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('infrastructure_characterization_description', 'Infrastructure Characterization Description') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('infrastructure_characterization_description', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Airport Catchment Area Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('airport_catchment_area', 'Airport Catchment Area') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('airport_catchment_area', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Competitors Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('competitors', 'Competitors') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('competitors', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Top1 Airline Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('top1_airline', 'Top1 Airline') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('top1_airline', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
    </div>
</div>

<!-- Top1 Airline Percentage Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('top1_airline_percentage', 'Top1 Airline Percentage') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('top1_airline_percentage', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Top2 Airline Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('top2_airline', 'Top2 Airline') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('top2_airline', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
    </div>
</div>

<!-- Top2 Airline Percentage Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('top2_airline_percentage', 'Top2 Airline Percentage') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('top2_airline_percentage', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Top3 Airline Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('top3_airline', 'Top3 Airline') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('top3_airline', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
    </div>
</div>

<!-- Top3 Airline Percentage Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('top3_airline_percentage', 'Top3 Airline Percentage') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('top3_airline_percentage', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Route Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('route', 'Route') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('route', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Master Plan Estimations Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('master_plan_estimations', 'Master Plan Estimations') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('master_plan_estimations', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Society Model Regulation Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('society_model_regulation', 'Society Model Regulation') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('society_model_regulation', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Aena Network Improvement Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('aena_network_improvement', 'Aena Network Improvement') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('aena_network_improvement', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Other Info Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('other_info', 'Other Info') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('other_info', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Data Year Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('data_year', 'Data Year') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('data_year', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Version Date Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('version_date', 'Version Date') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('version_date', null, ['class' => 'form-control','id'=>'version_date']) !!}
    </div>
</div>


<!-- Address Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 245,'maxlength' => 245]) !!}
</div> -->

<!-- City Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div> -->

<!-- Lat Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('lat', 'Lat:') !!}
    {!! Form::number('lat', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Long Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('long', 'Long:') !!}
    {!! Form::number('long', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Som Country Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('som_country_id', 'Som Country Id:') !!}
    {!! Form::number('som_country_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- location modal -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q&libraries=places"
  type="text/javascript"></script>
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span>Browse Map</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                    
                </button>
            </div>
            <div class="modal-body" id="locationModalBody">
                <div>
                    <div class="form-group row">                        
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="searchmap">
                                <div id="map-canvas"></div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('long', 'Current Location:') !!}
                        {!! Form::text('current_location', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
                    </div>
                    <div class="form-group col-sm-12" style="display: grid;justify-content: end;">
                         <a id="set_it" class="btn btn-default">Set It</a>
                    </div>
                </div>
            </div>
        </div>
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

<script>
    $(document).on('click', '#browse_map', function(event) {
        event.preventDefault();
        $('#locationModal').modal("show");
        
    });

    var map = new google.maps.Map(document.getElementById('map-canvas'),{
        center:{
            lat: 27.72,
            lng: 85.36
        },
        zoom:15
    });
    var marker = new google.maps.Marker({
        position: {
            lat: 27.72,
            lng: 85.36
        },
        map: map,
        draggable: true
    });
    var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
    google.maps.event.addListener(searchBox,'places_changed',function(){
        var places = searchBox.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for(i=0; place=places[i];i++){
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location); //set marker position new...
        }
        map.fitBounds(bounds);
        map.setZoom(15);
    });
    google.maps.event.addListener(marker,'position_changed',function(){
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        $('#lat').val(lat);
        $('#lng').val(lng);
    });
</script>
@endpush