<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $news->title }}</p>
</div>

<!-- News Description Field -->
<div class="col-sm-12">
    {!! Form::label('news_description', 'News Description:') !!}
    <p>{{ $news->news_description }}</p>
</div>

<!-- Date From Field -->
<div class="col-sm-12">
    {!! Form::label('date_from', 'Date From:') !!}
    <p>{{ $news->date_from }}</p>
</div>

<!-- Date Until Field -->
<div class="col-sm-12">
    {!! Form::label('date_until', 'Date Until:') !!}
    <p>{{ $news->date_until }}</p>
</div>

