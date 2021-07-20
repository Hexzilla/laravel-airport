
<input type="hidden" name="som_form_approvals_id" id="som_form_approvals_id" value="{!! $som_form_approvals_id !!}">

<!-- Is Final Approval Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('is_final_approval', 'Is Final Approval', ['class' => 'form-check-label']) !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-md-1">{!! Form::radio('is_final_approval', 0, ['class' => 'form-check-input']) !!}</div>
            <div class="col-md-11">No</div>
        </div>
        <div class="row">
            <div class="col-md-1">{!! Form::radio('is_final_approval', '1', null, ['class' => 'form-check-input','style'=>'margin-left:0px;']) !!}</div>
            <div class="col-md-11">Yes</div>
        </div>
    </div>
</div>

<!-- Cms Privilege Id Assigned Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('cms_privilege_id_assigned', 'Allow User with Privilege') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::select('cms_privilege_id_assigned', $data['cmsPrivileges'], $data['selected_privilege_id_assigned'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Cms Privilege Id Notify Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('cms_privilege_id_notify', 'Notify User with Privilege') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('cms_privilege_id_notify', $data['cmsPrivileges'], $data['selected_privilege_id_notify'], ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Order Approval Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order_approval', 'Order') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('order_approval', null, ['class' => 'form-control']) !!}
    </div>
</div>



