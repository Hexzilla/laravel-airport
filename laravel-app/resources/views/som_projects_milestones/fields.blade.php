<!-- Som Projects Phases Id Field -->
{{ Form::hidden('som_projects_phases_id', $somProjectsPhaseId) }}
{{ Form::hidden('order', 1) }}

<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255]) !!}
    </div>
</div>

<!-- Due Date Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('due_date', 'Due Date') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">@</div>
            </div>
            {!! Form::text('due_date', null, ['class' => 'form-control','id'=>'due_date']) !!}
        </div>
    </div>
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


<!-- Order Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('order', 'Order') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('order', null, ['class' => 'form-control','maxlength' => 3]) !!}
    </div>
</div>
<!-- Is Hidden Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('is_hidden', 'Is Hidden') !!}
        <span class="required">&nbsp</span>
    </div>
    <div class="col-sm-10">
        <div class="form-check">
            {!! Form::checkbox('is_hidden', true, !empty($somProjectsMilestones->is_hidden) ? true : false, array('id' => 'is_hidden', 'class' => 'form-check-input')) !!}
        </div>
    </div>
</div>
