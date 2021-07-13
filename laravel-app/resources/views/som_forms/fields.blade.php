{{ Form::hidden('active', $somForms->active) }}
{{ Form::hidden('som_phases_milestones_id', $somForms->som_phases_milestones_id) }}
{{ Form::hidden('som_milestones_forms_types_id', $somForms->som_milestones_forms_types_id) }}
{{ Form::hidden('order_form', $somForms->order_form) }}
<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
      {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Order Form Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order_form', 'Order') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
    {!! Form::number('order_form', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is_InActive Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('is_inactive', 'Is InActive') !!}
        <span class="required">&nbsp</span>
    </div>
    <div class="col-sm-10">
        <div class="form-check">
            {!! Form::checkbox('is_inactive', 1, !empty($somForms->is_inactive) ? true : false , array('id' => 'is_inactive', 'class' => 'form-check-input')) !!}
        </div>
    </div>
</div>
