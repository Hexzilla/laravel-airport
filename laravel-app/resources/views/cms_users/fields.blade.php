<!-- Status Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('status', 'Status') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('status', null, ['class' => 'form-control','maxlength' => 50,'maxlength' => 50]) !!}
    </div>
</div>

<!-- Photo Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('photo', 'Photo') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('photo', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

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
        {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Job Title Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('job_title', 'Application Role') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('job_title', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>
