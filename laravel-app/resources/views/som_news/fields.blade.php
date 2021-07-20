<!-- Title Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('title', 'Title ') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
      {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
    </div>
</div>

<!-- News Description Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('news_description', 'News Description ') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::textarea('news_description', null, ['class' => 'form-control','rows' => 4, 'cols' => 50,'maxlength' => 1000,'maxlength' => 1000]) !!}
    </div>
</div>

<!-- Date From Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('date_from', 'Date From ') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">@</div>
            </div>
            {!! Form::text('date_from', null, ['class' => 'form-control','id'=>'date_from']) !!}
        </div>
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_from').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Date Until Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('date_until', 'Date Until') !!}
        <span class="required">&nbsp</span>
    </div>
    <div class="col-sm-10">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">@</div>
            </div>
            {!! Form::text('date_until', null, ['class' => 'form-control','id'=>'date_until']) !!}
        </div>
    </div>
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
