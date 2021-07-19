
<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somCountries-table">
        <thead>
            <tr>
                <th>Country</th>
                <th>Code</th>
                <th>Description</th>
                <th>Politics</th>
                <th>Regulatory</th>
                <th>Corruption</th>
                <th>Ease of Doing Business</th>
                <th>Affinity with Spain</th>
                <th>Location aligned with Aena International Strategy</th>
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
        processing: false,
        serverSide: false,
        ajax: "{{ route('somCountries.index') }}",
        columns: [
            {data: 'country', name: 'country', orderable: true, searchable: true},
            {data: 'country_code', name: 'country_code', orderable: true, searchable: true},
            {data: 'description', name: 'description', orderable: true, searchable: true},
            {data: 'politics', name: 'politics', orderable: true, searchable: true},
            {data: 'regulatory', name: 'regulatory', orderable: true, searchable: true},
            {data: 'corruption', name: 'corruption', orderable: true, searchable: true},
            {data: 'business_easyness', name: 'business_easyness', orderable: true, searchable: true},
            {data: 'spain_affinity', name: 'spain_affinity', orderable: true, searchable: true},
            {data: 'aena_strategy_align', name: 'aena_strategy_align', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
