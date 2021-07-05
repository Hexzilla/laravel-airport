<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Hex Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hex_color', 'Hex Color:') !!}
    {!! Form::text('hex_color', null, ['class' => 'form-control','maxlength' => 8,'maxlength' => 8]) !!}
</div>

<!-- Is Visible Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_visible', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_visible', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label']) !!}
    </div>
</div>
