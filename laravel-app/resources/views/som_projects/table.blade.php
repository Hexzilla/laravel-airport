
<div class="table-responsive" style="padding: 10px;">
    <table class="table table-hover stripe table-bordered data-table" id="somProjects-table" width="100%">
        <thead>
            <tr class="active">
                <th width="3%"></th>
                <th width="auto">Image</th>
                <th width="auto">Name</th>
                <th width="auto">Description</th>
                <th width="auto">Transaction Type</th>
                <th width="auto">Asset Type</th>
                <th width="auto">Location</th>
                <th width="auto">Status</th>
                <th width="auto" style="text-align:right">Action</th>
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
                    {!! Form::open(['route' => ['somProjects.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
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
    $("#delete_form").attr("action","/somProjects/"+id);
    $('#deleteModal').modal("show");
}

$(function () {
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somProjects.index') }}",
        columns: [
            {data: 'is_template_project', name: 'is_template_project', orderable: true, searchable: true},
            {data: 'img_url', name: 'img_url', orderable: true, searchable: true},
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {data: 'sub_name', name: 'sub_name', orderable: true, searchable: true},
            {data: 'som_project_model_name', name: 'som_project_model_name', orderable: true, searchable: true},
            {data: 'som_project_process_type_name', name: 'som_project_process_type_name', orderable: true, searchable: true},
            {data: 'som_country_name', name: 'som_country_name', orderable: true, searchable: true},
            {data: 'som_project_info_status_name', name: 'som_project_info_status_name', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
