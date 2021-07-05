<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Projects Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_projects_id', 'Som Projects Id:') !!}
    {!! Form::number('som_projects_id', null, ['class' => 'form-control']) !!}
</div>