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


<!-- Som Forms Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_forms_id', 'Som Forms Id') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('som_forms_id', null, ['class' => 'form-control']) !!}
    </div>
</div>


<!-- Order Approval Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order_approval', 'Order Approval') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order_approval', null, ['class' => 'form-control']) !!}
    </div>
</div>