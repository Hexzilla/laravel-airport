<!-- Lastupdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastupdate', 'Lastupdate:') !!}
    {!! Form::text('lastupdate', null, ['class' => 'form-control','id'=>'lastupdate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#lastupdate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Form Approvals Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_form_approvals_id', 'Som Form Approvals Id:') !!}
    {!! Form::number('som_form_approvals_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_status_id', 'Som Status Id:') !!}
    {!! Form::number('som_status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Document Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_url', 'Document Url:') !!}
    {!! Form::text('document_url', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Doc Url Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doc_url_description', 'Doc Url Description:') !!}
    {!! Form::text('doc_url_description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Order Approval Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_approval', 'Order Approval:') !!}
    {!! Form::number('order_approval', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Final Approval Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_final_approval', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_final_approval', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_final_approval', 'Is Final Approval', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Cms Privilege Id Assigned Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_privilege_id_assigned', 'Cms Privilege Id Assigned:') !!}
    {!! Form::number('cms_privilege_id_assigned', null, ['class' => 'form-control']) !!}
</div>

<!-- Cms Privilege Id Notify Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_privilege_id_notify', 'Cms Privilege Id Notify:') !!}
    {!! Form::number('cms_privilege_id_notify', null, ['class' => 'form-control']) !!}
</div>