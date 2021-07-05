<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Forms Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_forms_id', 'Som Forms Id:') !!}
    {!! Form::number('som_forms_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Approval Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_approval', 'Order Approval:') !!}
    {!! Form::number('order_approval', null, ['class' => 'form-control']) !!}
</div>