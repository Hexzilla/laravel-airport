<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $cmsUsers->name }}</p>
</div>

<!-- Photo Field -->
<div class="col-sm-12">
    {!! Form::label('photo', 'Photo:') !!}
    <p>{{ $cmsUsers->photo }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $cmsUsers->email }}</p>
</div>

<!-- Password Field -->
<div class="col-sm-12">
    {!! Form::label('password', 'Password:') !!}
    <p>{{ $cmsUsers->password }}</p>
</div>

<!-- Id Cms Privileges Field -->
<div class="col-sm-12">
    {!! Form::label('id_cms_privileges', 'Id Cms Privileges:') !!}
    <p>{{ $cmsUsers->id_cms_privileges }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cmsUsers->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cmsUsers->updated_at }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $cmsUsers->status }}</p>
</div>

<!-- Job Title Field -->
<div class="col-sm-12">
    {!! Form::label('job_title', 'Job Title:') !!}
    <p>{{ $cmsUsers->job_title }}</p>
</div>

<!-- Objectguid Field -->
<div class="col-sm-12">
    {!! Form::label('objectguid', 'Objectguid:') !!}
    <p>{{ $cmsUsers->objectguid }}</p>
</div>

