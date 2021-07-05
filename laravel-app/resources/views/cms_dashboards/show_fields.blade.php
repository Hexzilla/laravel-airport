<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $cmsDashboard->name }}</p>
</div>

<!-- Id Cms Privileges Field -->
<div class="col-sm-12">
    {!! Form::label('id_cms_privileges', 'Id Cms Privileges:') !!}
    <p>{{ $cmsDashboard->id_cms_privileges }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $cmsDashboard->content }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cmsDashboard->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cmsDashboard->updated_at }}</p>
</div>

