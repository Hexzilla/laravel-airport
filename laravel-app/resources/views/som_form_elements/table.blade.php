<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somFormElements-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Document</th>
                <th>Doc Url Description</th>
                <th>Template</th>
                <th>Template Url Description</th>
                <th>Lastupdate</th>
                <th>Comment</th>
                <th>Som Forms Id</th>
                <th>Order Elements</th>
                <th>Is Mandatory</th>
                <th>Is Sub Element</th>
                <th>Tooltip</th>
                <th>Cms Privileges Role Id</th>
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
                    {!! Form::open(['route' => ['somFormElements.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
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
    $("#delete_form").attr("action","/somFormElements/"+id);
    $('#deleteModal').modal("show");
}

$(function () { 
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somFormElements.index', ['somforms_id'=>$somforms_id]) }}",
        columns: [   
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {data: 'document', name: 'document', orderable: true, searchable: true},
            {data: 'doc_url_description', name: 'doc_url_description', orderable: true, searchable: true},
            {data: 'template', name: 'template', orderable: true, searchable: true},
            {data: 'template_url_description', name: 'template_url_description', orderable: true, searchable: true},
            {data: 'lastupdate', name: 'lastupdate', orderable: true, searchable: true},
            {data: 'comment', name: 'comment', orderable: true, searchable: true},
            {data: 'som_forms_id', name: 'som_forms_id', orderable: true, searchable: true},
            {data: 'order_elements', name: 'order_elements', orderable: true, searchable: true},
            {data: 'is_mandatory', name: 'is_mandatory', orderable: true, searchable: true},
            {data: 'is_sub_element', name: 'is_sub_element', orderable: true, searchable: true},
            {data: 'tooltip', name: 'tooltip', orderable: true, searchable: true},
            {data: 'cms_privileges_role_id', name: 'cms_privileges_role_id', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });      
});
</script>
