<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somProjectsMilestones-table">
        <thead>
            <tr>
                <th>Som Projects Phases Id</th>
                <th>Blocking</th>
                <th>Order</th>
                <th>Due Date</th>
                <th>Name</th>
                <th>Som Status Id</th>
                <th>Is Hidden</th>
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
                    {!! Form::open(['route' => ['somProjectsMilestones.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
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
    $("#delete_form").attr("action","/somProjectsMilestones/"+id);
    $('#deleteModal').modal("show");
}

$(function () {

    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somProjectsMilestones.index' , ['phases_id'=>$somProjectsPhaseId]) }}",
        columns: [
            {data: 'som_projects_phases_id', name: 'som_projects_phases_id', orderable: true, searchable: true},
            {data: 'blocking', name: 'blocking', orderable: true, searchable: true},
            {data: 'order', name: 'order', orderable: true, searchable: true},
            {data: 'due_date', name: 'due_date', orderable: true, searchable: true},
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {data: 'som_status_id', name: 'som_status_id', orderable: true, searchable: true},
            {data: 'is_hidden', name: 'is_hidden', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>


