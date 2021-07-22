<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somProjectUsers-table">
        <thead>
            <tr>
                <th>Cms User</th>
                <th>Cms Privilege</th>
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
                <span>Delete User from Project</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="deleteModalBody">
                <div>
                    {!! Form::open(['route' => ['somProjectUsers.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
                    <input type="hidden" name="project_id" id="project_id" value="{!! $project_id !!}">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <span>Do you want to remove the selected user from the project?</span>
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
    $("#delete_form").attr("action","/somProjectUsers/"+id);
    $('#deleteModal').modal("show");
}

function closeDeleteModal(id){
    $('#deleteModal').modal("hide");
}


$(function () {

    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somProjectUsers.index', ['project_id'=>$project_id]) }}",
        columns: [
            {data: 'cms_users_name', name: 'cms_users_name', orderable: true, searchable: true},
            {data: 'cms_privileges_name', name: 'cms_privileges_name', orderable: true, searchable: true},          
            {data: 'action', name: 'action', orderable: false, searchable: false,sWidth:'15%'},
        ]
    });
});
</script>
