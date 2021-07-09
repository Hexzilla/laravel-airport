<!-- Som Projects Id Field 0712-->
{{ Form::hidden('som_projects_id', $somProjectID) }}
<!-- Name Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('name', 'Name') !!}
        <span class="required">*</span>
    </div>
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Email Field -->
{{--<div class="form-group row">--}}
    {{--<div class="col-sm-2 col-form-label text-right">--}}
        {{--{!! Form::label('email', 'Email') !!}--}}
    {{--</div>--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::text('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Phone Number Field -->
{{--<div class="form-group row">--}}
    {{--<div class="col-sm-2 col-form-label text-right">--}}
        {{--{!! Form::label('phone_number', 'Phone number') !!}--}}
    {{--</div>--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Other information Field -->
{{--<div class="form-group row">--}}
    {{--<div class="col-sm-2 col-form-label text-right">--}}
        {{--{!! Form::label('other_info', 'Other information') !!}--}}
    {{--</div>--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::text('other_info', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Company-->
{{--<div class="form-group row">--}}
    {{--<div class="col-sm-2 col-form-label text-right">--}}
        {{--{!! Form::label('company', 'Company') !!}--}}
    {{--</div>--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::text('company', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Company Profile-->
{{--<div class="form-group row">--}}
    {{--<div class="col-sm-2 col-form-label text-right">--}}
        {{--{!! Form::label('company_profile', 'Company Profile') !!}--}}
    {{--</div>--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::text('company_profile', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<!-- Role -->
{{--<div class="form-group row">--}}
    {{--<div class="col-sm-2 col-form-label text-right">--}}
        {{--{!! Form::label('role', 'Role in the Project') !!}--}}
    {{--</div>--}}
    {{--<div class="col-sm-10">--}}
        {{--{!! Form::text('role', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}--}}
    {{--</div>--}}
{{--</div>--}}