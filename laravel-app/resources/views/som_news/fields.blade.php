<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title *') !!}
    {!! Form::text('title', null, ['class' => 'form-control required','maxlength' => 100,'maxlength' => 100]) !!}
</div>

<!-- News Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('news_description', 'News Description *') !!}
    {!! Form::textarea('news_description', null, ['class' => 'form-control required','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Date From Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date_from', 'Date From *') !!}
    {!! Form::text('date_from', null, ['class' => 'form-control required date','id'=>'date_from']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_from').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
        })
    </script>
@endpush

<!-- Date Until Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date_until', 'Date Until:') !!}
    {!! Form::text('date_until', null, ['class' => 'form-control required','id'=>'date_until']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_until').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
