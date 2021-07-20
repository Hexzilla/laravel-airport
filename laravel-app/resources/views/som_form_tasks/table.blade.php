<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somFormTasks-table">
        <thead>
            <tr>
                <th class="w-50">Task</th>
                <th>Department</th>
                <th>Order</th>
                <th>Tooltip</th>
                <th>Type</th>
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
                    {!! Form::open(['route' => ['somFormTasks.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
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
    $("#delete_form").attr("action","/somFormTasks/"+id);
    $('#deleteModal').modal("show");
}

$(function () { 
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somFormTasks.index', ['somforms_id'=>$somforms_id]) }}",
        columns: [   
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {data: 'som_departments_id', name: 'som_departments_id', orderable: true, searchable: true},
            {data: 'order', name: 'order', orderable: true, searchable: true},
            {data: 'tooltip', name: 'tooltip', orderable: true, searchable: true},
            {data: 'is_sub_task', name: 'is_sub_task', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });      
});
</script>
