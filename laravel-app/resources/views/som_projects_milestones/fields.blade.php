<!-- Som Projects Phases Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_projects_phases_id', 'Som Projects Phases Id:') !!}
    {!! Form::number('som_projects_phases_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Blocking Field -->
<div class="form-group col-sm-6">
    {!! Form::label('blocking', 'Blocking:') !!}
    {!! Form::number('blocking', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Order:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Due Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('due_date', 'Due Date:') !!}
    {!! Form::text('due_date', null, ['class' => 'form-control','id'=>'due_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#due_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_status_id', 'Som Status Id:') !!}
    {!! Form::number('som_status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Hidden Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_hidden', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_hidden', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_hidden', 'Is Hidden', ['class' => 'form-check-label']) !!}
    </div>
</div>
