<!-- Screetkey Field -->
<div class="col-sm-12">
    {!! Form::label('screetkey', 'Screetkey:') !!}
    <p>{{ $cmsApiKey->screetkey }}</p>
</div>

<!-- Hit Field -->
<div class="col-sm-12">
    {!! Form::label('hit', 'Hit:') !!}
    <p>{{ $cmsApiKey->hit }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $cmsApiKey->status }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cmsApiKey->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cmsApiKey->updated_at }}</p>
</div>

