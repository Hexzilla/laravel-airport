{{ Form::hidden('active', $somForms->active == 'on' ? 1 : 0) }}
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

<!-- Active Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('active', 'Active') !!}
        <span class="required">&nbsp</span>
    </div>
    <div class="col-sm-10">
        <div class="form-check">
            {!! Form::checkbox('active', null, true, array('id' => 'active', 'class' => 'form-check-input')) !!}
        </div>
    </div>
</div>
