<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Projects Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_projects_id', 'Som Projects Id:') !!}
    {!! Form::number('som_projects_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company', 'Company:') !!}
    {!! Form::text('company', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Company Profile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_profile', 'Company Profile:') !!}
    {!! Form::text('company_profile', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Role In Project Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_in_project', 'Role In Project:') !!}
    {!! Form::text('role_in_project', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 250,'maxlength' => 250]) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Other Information Field -->
<div class="form-group col-sm-6">
    {!! Form::label('other_information', 'Other Information:') !!}
    {!! Form::text('other_information', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
</div>