<!-- Som Departments Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('som_departments_id', 'Som Departments Id:') !!}
    {!! Form::number('som_departments_id', null, ['class' => 'form-control']) !!}
</div> -->
<input type="hidden" name="som_departments_id" id="som_departments_id" value="{!! $som_departments_id !!}">

<!-- Cms Users Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_users_id', 'Cms Users Id:') !!}
    <!-- {!! Form::number('cms_users_id', null, ['class' => 'form-control']) !!} -->
    {!! Form::select('cms_users_id', $data['users'], $data['selected_user'], ['class' => 'form-control','onchange'=>'formatCountry()']) !!}
</div>