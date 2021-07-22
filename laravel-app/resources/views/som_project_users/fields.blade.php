<!-- Som Projects Id Field -->
<input type="hidden" name="som_projects_id" id="som_projects_id" value="{!! $project_id !!}">

<!-- Cms Users Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('cms_users_id', 'Cms User') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('cms_users_id', $data['users'], $data['selected_user'], ['class' => 'form-control','onchange'=>'formatCountry()']) !!}
    </div>
</div>

<!-- Cms Privileges Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('cms_privileges_id', 'Cms Privilege') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('cms_privileges_id', $data['privileges'], $data['selected_privilege'], ['class' => 'form-control','onchange'=>'formatCountry()']) !!}
    </div>
</div>
