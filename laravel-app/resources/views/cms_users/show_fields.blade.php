<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Has Access:') !!}
    <p>{{ $cmsUsers->status }}</p>
</div>

<!-- Photo Field -->
<div class="col-sm-12">
    {!! Form::label('photo', 'Photo:') !!}
    <p>{{ $cmsUsers->photo }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $cmsUsers->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $cmsUsers->email }}</p>
</div>

<!-- Job Title Field -->
<div class="col-sm-12">
    {!! Form::label('job_title', 'Application Role:') !!}
    <p>{{ $cmsUsers->job_title }}</p>
</div>
