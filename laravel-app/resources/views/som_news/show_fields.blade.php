<!-- Title Field -->
<div class="col-lg-12">
    {!! Form::label('title', 'Title *') !!}
    <p>{{ $somNews->title }}</p>
</div>

<!-- News Description Field -->
<div class="col-lg-12">
    {!! Form::label('news_description', 'News Description *') !!}
    <p>{{ $somNews->news_description }}</p>
</div>

<!-- Date From Field -->
<div class="col-lg-12">
    {!! Form::label('date_from', 'Date From *') !!}
    <p>{{ $somNews->date_from }}</p>
</div>

<!-- Date Until Field -->
<div class="col-lg-12">
    {!! Form::label('date_until', 'Date Until') !!}
    <p>{{ $somNews->date_until }}</p>
</div>

