<!-- Hex Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hex_color', 'Hex Color:') !!}
    {!! Form::text('hex_color', null, ['class' => 'form-control','maxlength' => 8,'maxlength' => 8]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:') !!}
    {!! Form::text('icon', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Display Text Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_text', 'Display Text:') !!}
    {!! Form::text('display_text', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45]) !!}
</div>

<!-- Is Behaviour Completed Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_behaviour_completed', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_behaviour_completed', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_behaviour_completed', 'Is Behaviour Completed', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Behaviour Rejected Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_behaviour_rejected', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_behaviour_rejected', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_behaviour_rejected', 'Is Behaviour Rejected', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Behaviour Ongoing Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_behaviour_ongoing', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_behaviour_ongoing', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_behaviour_ongoing', 'Is Behaviour Ongoing', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Behaviour Review Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_behaviour_review', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_behaviour_review', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_behaviour_review', 'Is Behaviour Review', ['class' => 'form-check-label']) !!}
    </div>
</div>
