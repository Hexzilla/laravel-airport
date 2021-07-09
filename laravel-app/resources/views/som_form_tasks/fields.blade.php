<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
    </div>
</div>

<!-- Order Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Order') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Tooltip Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('tooltip', 'Tooltip') !!}
        <span class="required">&nbsp;</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('tooltip', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
    </div>
</div>

<!-- Type Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Type') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Role Assigned -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Role Assigned') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Department -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Department') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::number('order', null, ['class' => 'form-control']) !!}
    </div>
</div>