<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $cmsPrivileges->name }}</p>
</div>

<!-- Is Superadmin Field -->
<div class="col-sm-12">
    {!! Form::label('is_superadmin', 'Is Superadmin:') !!}
    <p>{{ $cmsPrivileges->is_superadmin }}</p>
</div>

<!-- Theme Color Field -->
<div class="col-sm-12">
    {!! Form::label('theme_color', 'Theme Color:') !!}
    <p>{{ $cmsPrivileges->theme_color }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cmsPrivileges->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cmsPrivileges->updated_at }}</p>
</div>

<!-- Is App Role Field -->
<div class="col-sm-12">
    {!! Form::label('is_app_role', 'Is App Role:') !!}
    <p>{{ $cmsPrivileges->is_app_role }}</p>
</div>

<!-- Is Project Role Field -->
<div class="col-sm-12">
    {!! Form::label('is_project_role', 'Is Project Role:') !!}
    <p>{{ $cmsPrivileges->is_project_role }}</p>
</div>

