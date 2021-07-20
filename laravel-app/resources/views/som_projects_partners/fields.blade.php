<!-- Som Projects Id Field -->
{{ Form::hidden('som_projects_id', $somProjectID) }}
{{--{{ $somProjectsPartners->som_projects_id }}--}}

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
    </div>
    <div class="col-sm-10">
        {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
    </div>
</div>

<!-- Phone Number Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('phone_number', 'Phone Number') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
    </div>
</div>

<!-- Other Information Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('other_information', 'Other Information') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('other_information', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
    </div>
</div>

<!-- Company Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('company', 'Company') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('company', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
    </div>
</div>

<!-- Company Profile Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('company_profile', 'Company Profile') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('company_profile', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
    </div>
</div>

<!-- Role In Project Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('role_in_project', 'Role In Project') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('role_in_project', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
    </div>
</div>