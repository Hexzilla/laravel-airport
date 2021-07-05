<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::number('active', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Phases Milestones Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_phases_milestones_id', 'Som Phases Milestones Id:') !!}
    {!! Form::number('som_phases_milestones_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Form Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_form', 'Order Form:') !!}
    {!! Form::number('order_form', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Milestones Forms Types Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_milestones_forms_types_id', 'Som Milestones Forms Types Id:') !!}
    {!! Form::number('som_milestones_forms_types_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_status_id', 'Som Status Id:') !!}
    {!! Form::number('som_status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Inactive Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_inactive', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_inactive', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_inactive', 'Is Inactive', ['class' => 'form-check-label']) !!}
    </div>
</div>
