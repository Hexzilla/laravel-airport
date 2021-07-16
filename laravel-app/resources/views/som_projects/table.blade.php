
<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somProjects-table">
        <thead>
            <tr>
                <th>Master</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Transactio Type</th>
                <th>Asset Type</th>
                <th>Location</th>
                <th>Status</th>
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
        processing: true,
        serverSide: true,
        ajax: "{{ route('somProjects.index') }}",
        columns: [   
            {data: 'is_template_project', name: 'is_template_project'}, 
            {data: 'img_url', name: 'img_url'},  
            {data: 'name', name: 'name'}, 
            {data: 'sub_name', name: 'sub_name'}, 
            {data: 'som_project_model_name', name: 'som_project_model_name'},
            {data: 'som_project_process_type_name', name: 'som_project_process_type_name'},
            {data: 'som_country_name', name: 'som_country_name'},
            {data: 'som_project_info_status_name', name: 'som_project_info_status_name'},            
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
