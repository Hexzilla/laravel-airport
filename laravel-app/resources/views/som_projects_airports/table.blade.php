<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somAirports-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Iata Oaci</th>
                <th>Som Projects Airport Type</th>
                <th>Size</th>
                <th>Revenues Aeronautical</th>
                <th>Revenues Non Aeronautical</th>
                <th>Total Revenues</th>
                <th>Total Opex</th>
                <th>Ebitda</th>
                <th>Kpi Revenues Aeronautical</th>
                <th>Kpi Revenues Non Aeronautical</th>
                <th>Kpi Ebitda</th>
                <th>Percentage International</th>
                <th>Percentage Transfer</th>
                <th>Percentage Non Low Cost</th>
                <th>Infrastructure Characterization Description</th>
                <th>Airport Catchment Area</th>
                <th>Competitors</th>
                <th>Top1 Airline</th>
                <th>Top2 Airline</th>
                <th>Top3 Airline</th>
                <th>Top1 Airline Percentage</th>
                <th>Top2 Airline Percentage</th>
                <th>Top3 Airline Percentage</th>
                <th>Route</th>
                <th>Master Plan Estimations</th>
                <th>Society Model Regulation</th>
                <th>Aena Network Improvement</th> 
                <th>Debt Ebitda</th>
                <th>Img Url</th>
                <th>Som Country Id</th>
                <th>Other Info</th>
                <th>Data Year</th>
                <th>Version Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
</div>

<!-- ============================== delete modal ================================== -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span>Delete Item</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteModalBody">
                <div>
                    {!! Form::open(['route' => ['somAirports.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
                    <div class="form-group row">
                        <div class="col-md-12">
                            <span>Are you sure?</span>                            
                        </div>
                    </div>                    
                    <div class="form-group col-sm-12" style="display: grid;justify-content: end;">
                        {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function openDeleteModal(id){
    $("#delete_form").attr("action","/somAirports/"+id);
    $('#deleteModal').modal("show");
}

$(function () { 
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somAirports.index') }}",
        columns: [   
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {data: 'address', name: 'address', orderable: true, searchable: true},
            {data: 'city', name: 'city', orderable: true, searchable: true},
            {data: 'country', name: 'country', orderable: true, searchable: true},
            {data: 'lat', name: 'lat', orderable: true, searchable: true},
            {data: 'long', name: 'long', orderable: true, searchable: true},
            {data: 'iata_oaci', name: 'iata_oaci', orderable: true, searchable: true},
            {data: 'som_projects_airport_type_name', name: 'som_projects_airport_type_name', orderable: true, searchable: true},
            {data: 'size', name: 'size', orderable: true, searchable: true},
            {data: 'revenues_aeronautical', name: 'revenues_aeronautical', orderable: true, searchable: true},
            {data: 'revenues_non_aeronautical', name: 'revenues_non_aeronautical', orderable: true, searchable: true},
            {data: 'total_revenues', name: 'total_revenues', orderable: true, searchable: true},
            {data: 'total_opex', name: 'total_opex', orderable: true, searchable: true},
            {data: 'ebitda', name: 'ebitda', orderable: true, searchable: true},
            {data: 'kpi_revenues_aeronautical', name: 'kpi_revenues_aeronautical', orderable: true, searchable: true},
            {data: 'kpi_revenues_non_aeronautical', name: 'kpi_revenues_non_aeronautical', orderable: true, searchable: true},
            {data: 'kpi_ebitda', name: 'kpi_ebitda', orderable: true, searchable: true},
            {data: 'percentage_international', name: 'percentage_international', orderable: true, searchable: true},
            {data: 'percentage_transfer', name: 'percentage_transfer', orderable: true, searchable: true},
            {data: 'percentage_non_low_cost', name: 'percentage_non_low_cost', orderable: true, searchable: true},
            {data: 'infrastructure_characterization_description', name: 'infrastructure_characterization_description', orderable: true, searchable: true},
            {data: 'airport_catchment_area', name: 'airport_catchment_area', orderable: true, searchable: true},
            {data: 'competitors', name: 'competitors', orderable: true, searchable: true},
            {data: 'top1_airline', name: 'top1_airline', orderable: true, searchable: true},
            {data: 'top2_airline', name: 'top2_airline', orderable: true, searchable: true},
            {data: 'top3_airline', name: 'top3_airline', orderable: true, searchable: true},
            {data: 'top1_airline_percentage', name: 'top1_airline_percentage', orderable: true, searchable: true},
            {data: 'top2_airline_percentage', name: 'top2_airline_percentage', orderable: true, searchable: true},
            {data: 'top3_airline_percentage', name: 'top3_airline_percentage', orderable: true, searchable: true},
            {data: 'route', name: 'route', orderable: true, searchable: true},
            {data: 'master_plan_estimations', name: 'master_plan_estimations', orderable: true, searchable: true},
            {data: 'society_model_regulation', name: 'society_model_regulation', orderable: true, searchable: true},
            {data: 'aena_network_improvement', name: 'aena_network_improvement', orderable: true, searchable: true},
            {data: 'debt_ebitda', name: 'debt_ebitda', orderable: true, searchable: true},
            {data: 'img_url', name: 'img_url', orderable: true, searchable: true},
            {data: 'som_country_id', name: 'som_country_id', orderable: true, searchable: true},
            {data: 'other_info', name: 'other_info', orderable: true, searchable: true},
            {data: 'data_year', name: 'data_year', orderable: true, searchable: true},
            {data: 'version_date', name: 'version_date', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],        
    });      
});
</script>
