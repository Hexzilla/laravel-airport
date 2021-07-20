<div class="table-responsive" style="padding: 10px;">
    <table class="table table-bordered data-table" id="somNews-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>News Description</th>
                <th>Date From</th>
                <th>Date Until</th>
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
                    {!! Form::open(['route' => ['somNews.destroy', '0'], 'id'=>'delete_form', 'method' => 'delete']) !!}
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
    $("#delete_form").attr("action","/somNews/"+id);
    $('#deleteModal').modal("show");
}

$(function () { 
    
    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: false,
        ajax: "{{ route('somNews.index') }}",
        columns: [   
            {data: 'title', name: 'title', orderable: true, searchable: true},
            {data: 'news_description', name: 'news_description', orderable: true, searchable: true},
            {data: 'date_from', name: 'date_from', orderable: true, searchable: true},
            {data: 'date_until', name: 'date_until', orderable: true, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });      
});
</script>
