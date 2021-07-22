<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somProjectsAdvisors-table">
        <thead>
            <tr>
                <th>Name</th>
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
                <span>Delete Advisor from project</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteModalBody">
                <div>
                    {!! Form::open(['route' => ['somProjectsAdvisors.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
                    <div class="form-group row">
                        <div class="col-md-12">
                            <span>Do you want to remove the selected advisor from the project?</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12" style="display: flex;justify-content: flex-end;">
                        {!! Form::button('Cancel', ['class' => 'btn btn-xs', 'onclick'=>'closeDeleteModal()']) !!}
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
    $("#delete_form").attr("action","/somProjectsAdvisors/"+id);
    $('#deleteModal').modal("show");
}

function closeDeleteModal(id){
    $('#deleteModal').modal("hide");
}

$(function () {

    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somProjectsAdvisors.index', ['project_id'=>$somProjectID]) }}",
        columns: [
            {data: 'name', name: 'name', orderable: true, searchable: true},           
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
