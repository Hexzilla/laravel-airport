<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somApprovalsResponsibles-table">
        <thead>
            <tr>
                <!-- <th>Lastupdate</th>
                <th>Comment</th> -->
                <th>Approvals</th>
                <!-- <th>Som Status Id</th> 
                <th>Document Url</th>
                <th>Doc Url Description</th> -->
                <th>Allow User with Privilege</th>
                <th>Notify User with Privilege</th>
                <th>Order</th>
                <th>Is Final Approval</th>  
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
                    {!! Form::open(['route' => ['somApprovalsResponsibles.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
                    <input type="hidden" name="som_form_approvals_id" id="som_form_approvals_id" value="{!! $som_form_approvals_id !!}">
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
    $("#delete_form").attr("action","/somApprovalsResponsibles/"+id);
    $('#deleteModal').modal("show");
}

$(function () { 
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somApprovalsResponsibles.index', ['som_form_approvals_id'=>$som_form_approvals_id]) }}",
        columns: [   
            // {data: 'lastupdate', name: 'lastupdate', orderable: true, searchable: true},
            // {data: 'comment', name: 'comment', orderable: true, searchable: true},
            {data: 'som_form_approvals_name', name: 'som_form_approvals_name', orderable: true, searchable: true},
            // {data: 'som_status_id', name: 'som_status_id', orderable: true, searchable: true},
            // {data: 'document_url', name: 'document_url', orderable: true, searchable: true},
            // {data: 'doc_url_description', name: 'doc_url_description', orderable: true, searchable: true},
            {data: 'cms_privileges_assigned_name', name: 'cms_privileges_assigned_name', orderable: true, searchable: true},
            {data: 'cms_privileges_notify_name', name: 'cms_privileges_notify_name', orderable: true, searchable: true},
            {data: 'order_approval', name: 'order_approval', orderable: true, searchable: true},
            {data: 'is_final_approval', name: 'is_final_approval', orderable: true, searchable: true}, 
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });      
});
</script>
