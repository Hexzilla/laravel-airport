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

<!-- Email Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('email', 'Email') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Phone Number Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('phone_number', 'Phone number') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Other information Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('other_info', 'Other information') !!}
        <span class="required">&nbsp;</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('other_info', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Company-->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('company', 'Company') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('company', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Company Profile-->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('company_profile', 'Company Profile') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('company_profile', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Role -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('role', 'Role in the Project') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('role', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>