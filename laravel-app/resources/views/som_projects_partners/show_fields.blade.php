<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $somProjectsPartners->name }}</p>
</div>

<!-- Som Projects Id Field -->
<div class="col-sm-12" style='display:none;'>
    {!! Form::label('som_projects_id', 'Som Projects Id:') !!}
    <p>{{ $somProjectsPartners->som_projects_id }}</p>
</div>

<!-- Company Field -->
<div class="col-sm-12">
    {!! Form::label('company', 'Company:') !!}
    <p>{{ $somProjectsPartners->company }}</p>
</div>

<!-- Company Profile Field -->
<div class="col-sm-12">
    {!! Form::label('company_profile', 'Company Profile:') !!}
    <p>{{ $somProjectsPartners->company_profile }}</p>
</div>

<!-- Role In Project Field -->
<div class="col-sm-12">
    {!! Form::label('role_in_project', 'Role In Project:') !!}
    <p>{{ $somProjectsPartners->role_in_project }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $somProjectsPartners->email }}</p>
</div>

<!-- Phone Number Field -->
<div class="col-sm-12">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    <p>{{ $somProjectsPartners->phone_number }}</p>
</div>

<!-- Other Information Field -->
<div class="col-sm-12">
    {!! Form::label('other_information', 'Other Information:') !!}
    <p>{{ $somProjectsPartners->other_information }}</p>
</div>

