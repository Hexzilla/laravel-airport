<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $somPhases->name }}</p>
</div>

<!-- Hex Color Field -->
<div class="col-sm-12">
    {!! Form::label('hex_color', 'Hex Color:') !!}
    <p>{{ $somPhases->hex_color }}</p>
</div>

<!-- Is Visible Field -->
<div class="col-sm-12">
    {!! Form::label('is_visible', 'Is Visible:') !!}
    <p>{{ $somPhases->is_visible }}</p>
</div>

