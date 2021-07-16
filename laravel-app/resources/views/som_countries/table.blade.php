
<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somCountries-table">
        <thead>
            <tr>
                <th>Country</th>
                <th>Country Code</th>
                <th>Description</th>
                <th>Politics</th>
                <th>Regulatory</th>
                <th>Corruption</th>
                <th>Business Easyness</th>
                <th>Spain Affinity</th>
                <th>Aena Strategy Align</th>
                <th>Tourism Activity</th>
                <th>Country Risk</th>
                <th>Imports Exports</th>
                <th>Version Date</th>
                <th>Exchange Rate</th>
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
                    {!! Form::open(['route' => ['somCountries.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
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
    $("#delete_form").attr("action","/somCountries/"+id);
    $('#deleteModal').modal("show");
}

$(function () { 
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('somCountries.index') }}",
        columns: [   
            {data: 'country', name: 'country'},
            {data: 'country_code', name: 'country_code'},
            {data: 'description', name: 'description'},
            {data: 'politics', name: 'politics'},
            {data: 'regulatory', name: 'regulatory'},
            {data: 'corruption', name: 'corruption'},
            {data: 'business_easyness', name: 'business_easyness'},
            {data: 'spain_affinity', name: 'spain_affinity'},
            {data: 'aena_strategy_align', name: 'aena_strategy_align'},
            {data: 'tourism_activity', name: 'tourism_activity'},
            {data: 'country_risk', name: 'country_risk'},
            {data: 'imports_exports', name: 'imports_exports'},
            {data: 'version_date', name: 'version_date'},
            {data: 'exchange_rate', name: 'exchange_rate'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });      
});
</script>
