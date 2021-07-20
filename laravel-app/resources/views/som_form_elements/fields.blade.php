<!-- Name Field -->
<style>

	.sm-ml--50 {
	    margin-left:-50%;
	 }

 @media (min-width: 576px){
    .sm-ml--50 {
       margin-left:0;
    }
}
</style>
{!! Form::hidden('som_forms_id', $somforms_id, []) !!}
<div class="form-group row">
    <div class="col-sm-3 col-form-label text-sm-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-3 col-form-label text-sm-right">
        {!! Form::label('order_elements', 'Order') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-9">
        {!! Form::text('order_elements', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-3 col-form-label text-sm-right">
        {!! Form::label('tooltip', 'Tooltip') !!}
    </div>
    <div class="col-sm-9">
    {!! Form::textarea('tooltip', null, ['class' => 'form-control','rows' => 3,'maxlength' => 2000,'maxlength' => 2000]) !!}
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-3 col-6 col-form-label text-sm-right" style="padding-left: 30px;">
        {!! Form::label('is_mandatory', 'Mandatory') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-9 col-6 sm-ml--50">
        <div class="form-check" style="margin-top:8px">
        {!! Form::hidden('is_mandatory', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_mandatory', '1', null, ['class' => 'form-check form-check-input']) !!}
        </div>
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-3 col-form-label text-sm-right">
        {!! Form::label('is_sub_element', 'Type') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-9">
    {!! Form::select('is_sub_element', $elementTypes, $somFormElements->is_sub_element, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group row">
    <div class="col-sm-3 col-form-label text-sm-right">
        {!! Form::label('cms_privileges_role_id', 'Role Assigned') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-9">
    {!! Form::select('cms_privileges_role_id', $arrRole, $somFormElements->cms_privileges_role_id, ['class' => 'form-control']) !!}
    </div>
</div>

