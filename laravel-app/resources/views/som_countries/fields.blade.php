<style>
    #map-canvas{
        width: 468px;
        height: 350px;
    }
    .pac-container { z-index: 100000 !important; }
    #searchmap{
        width: 220px;
        margin-top: 10px;
    }
</style>

<input type="hidden" name="id" id="id" value="{!! $data['id'] !!}">
<!-- Country Code Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country_code', 'Country Code:') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-8">
        {!! Form::text('country_code', null, ['class' => 'form-control','maxlength' => 2,'maxlength' => 2]) !!}
    </div>
    <div class="col-sm-2">
        <a id="browse_map" class="btn btn-default" style="background-color:#009aff;color:#fff;float:right;">Browse Map</a>
    </div>
</div>

<!-- Country Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country', 'Country') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('country', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
    </div>
</div>

<!-- Description Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('description', 'Description') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::textarea('description', null, ['class' => 'form-control','rows' => 4, 'cols' => 50,'maxlength' => 500,'maxlength' => 500]) !!}
    </div>
</div>

<!-- Politics Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('politics', 'Politics') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('politics',$items, null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Regulatory Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('regulatory', 'Regulatory') !!}
    </div>
    <div class="col-sm-10">
    {!! Form::select('regulatory',$items, null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Corruption Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('corruption', 'Corruption') !!}
    </div>
    <div class="col-sm-10">
    {!! Form::select('corruption',$items, null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Business Easyness Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('business_easyness', 'Easy of doing business') !!}
    </div>
    <div class="col-sm-10">
    {!! Form::select('business_easyness',$items, null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Spain Affinity Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('spain_affinity', 'Afinity with Spain') !!}
    </div>
    <div class="col-sm-10">
    {!! Form::select('spain_affinity',$items, null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Aena Strategy Align Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('aena_strategy_align', 'Location aligned with Aena international strategy') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('aena_strategy_align',array('Yes' => 'Yes', 'No' => 'No'), null, ['class' => 'form-control','maxlength' => 3,'maxlength' => 3]) !!}
    </div>
</div>

<!-- Country Risk Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('country_risk', 'Country Risk') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('country_risk', $items, null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
    </div>
</div>

<!-- Tourism Activity Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('tourism_activity', 'Tourism Situation (% PIB from tourism activity)') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('tourism_activity', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Imports Exports Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('imports_exports', 'Exports and imports(€ bn)') !!}
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
            format: 'YYYY-MM-DD',
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

<!-- location modal -->
<script
      src="https://maps.googleapis.com/maps/api/js?key={!! env('GOOGLE_MAPAPI_KEY') !!}&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
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
                            <input type="text" class="form-control" id="searchmap" style="display:none;">
                            <div id="map-canvas"></div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('current_country_code', 'Country Code:') !!}
                        {!! Form::text('current_country_code', null, ['class' => 'form-control','id' =>'current_country_code','maxlength' => 45,'maxlength' => 45]) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('current_country_name', 'Country Name:') !!}
                        {!! Form::text('current_country_name', null, ['class' => 'form-control','id' =>'current_country_name','maxlength' => 45,'maxlength' => 45]) !!}
                    </div>
                    <div class="form-group col-sm-12" style="display: grid;justify-content: end;">
                         <a id="set_it" class="btn btn-default" onclick="set_location()">Set It</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page_scripts')
<script>
$(document).on('click', '#browse_map', function(event) {
    event.preventDefault();
    $("#current_country_code").val($("#country_code").val());
    $("#current_country_name").val($("#country").val());
    $('#locationModal').modal("show");

});

function set_location(){
    $("#country_code").val($("#current_country_code").val());
    $("#country").val($("#current_country_name").val());
    $('#locationModal').modal("hide");
}

function initAutocomplete() {
    $("#searchmap").css("display","block");
    var init_lat = 0;//-33.8688;
    var init_lng= 0;//151.2195;
    var map;
    var marker;
    var selected_position = {lat: init_lat,lng: init_lng };
    if($("#country").val() != ""){
        map = new google.maps.Map(document.getElementById("map-canvas"), {
            zoom: 4,
        });
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ address: $("#country").val() })
            .then((response) => {
              const position = response.results[0].geometry.location;
              map.setCenter(position);
                selected_position = position;
                if(marker){
                    marker.setPosition(selected_position);
                    if(infoWindow)
                        infoWindow.setContent($("#country").val());
                }
            })
            .catch((e) =>
              window.alert("Geocode was not successful for the following reason: " + e)
            );
    }else{
        map = new google.maps.Map(document.getElementById("map-canvas"), {
            center: { lat: init_lat, lng: init_lng },
            zoom: 4,
            mapTypeId: "roadmap",
        });
    }

    marker = new google.maps.Marker({
        position: selected_position,
        map: map,
        draggable: true
    });



    // Create an info window to share between markers.
    const infoWindow = new google.maps.InfoWindow();

    // Create the search box and link it to the UI element.
    const input = document.getElementById("searchmap");
    const searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        // searchBox.setBounds(map.getBounds());
    });

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();
        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }
            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            marker.setPosition(place.geometry.location);
            infoWindow.setContent(place.formatted_address);

            for (var i = 0; i < place.address_components.length; i++) {
                var types = place.address_components[i].types;
                if(types.indexOf("country")>=0){
                    // console.log("country code"+i+":"+place.address_components[i].short_name);
                    $("#current_country_code").val(place.address_components[i].short_name);
                    $("#current_country_name").val(place.address_components[i].long_name);
                    break;
                }
            }

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });

    marker.addListener("position_changed", () => {
        infoWindow.open(marker.getMap(), marker);
    });
    marker.addListener("dragend", () => {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({latLng: marker.getPosition()}
            ,function(results, status){
                if (status == google.maps.GeocoderStatus.OK){
                    infoWindow.setContent(results[0].formatted_address);

                    for (var i = 0; i < results[0].address_components.length; i++) {
                        var types = results[0].address_components[i].types;
                        if(types.indexOf("country")>=0){
                            // console.log("country code"+i+":"+results[0].address_components[i].short_name);//long_name
                            $("#current_country_code").val(results[0].address_components[i].short_name);
                            $("#current_country_name").val(results[0].address_components[i].long_name);
                            break;
                        }
                    }
                }
            }
        );
    });
}

</script>
@endpush
