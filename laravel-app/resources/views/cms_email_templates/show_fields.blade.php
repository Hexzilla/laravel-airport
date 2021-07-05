<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $cmsEmailTemplates->name }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $cmsEmailTemplates->slug }}</p>
</div>

<!-- Subject Field -->
<div class="col-sm-12">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{{ $cmsEmailTemplates->subject }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $cmsEmailTemplates->content }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $cmsEmailTemplates->description }}</p>
</div>

<!-- From Name Field -->
<div class="col-sm-12">
    {!! Form::label('from_name', 'From Name:') !!}
    <p>{{ $cmsEmailTemplates->from_name }}</p>
</div>

<!-- From Email Field -->
<div class="col-sm-12">
    {!! Form::label('from_email', 'From Email:') !!}
    <p>{{ $cmsEmailTemplates->from_email }}</p>
</div>

<!-- Cc Email Field -->
<div class="col-sm-12">
    {!! Form::label('cc_email', 'Cc Email:') !!}
    <p>{{ $cmsEmailTemplates->cc_email }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cmsEmailTemplates->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cmsEmailTemplates->updated_at }}</p>
</div>

