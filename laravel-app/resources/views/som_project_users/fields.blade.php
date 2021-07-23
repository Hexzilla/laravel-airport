<!-- Som Projects Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('som_projects_id', 'Som Projects Id:') !!}
    {!! Form::number('som_projects_id', null, ['class' => 'form-control']) !!}
</div> -->
<input type="hidden" name="som_projects_id" id="som_projects_id" value="{!! $project_id !!}">
<!-- Cms Users Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_users_id', 'User *') !!}
    <!-- {!! Form::number('cms_users_id', null, ['class' => 'form-control']) !!} -->
    {!! Form::select('cms_users_id', $data['users'], $data['selected_user'], ['class' => 'form-control']) !!}
</div>

<!-- Cms Privileges Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_privileges_id', 'Privilege *') !!}
    <!-- {!! Form::number('cms_privileges_id', null, ['class' => 'form-control']) !!} -->
    {!! Form::select('cms_privileges_id', $data['privileges'], $data['selected_privilege'], ['class' => 'form-control']) !!}
</div>