<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document', 'Document:') !!}
    {!! Form::text('document', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Doc Url Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doc_url_description', 'Doc Url Description:') !!}
    {!! Form::text('doc_url_description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Template Field -->
<div class="form-group col-sm-6">
    {!! Form::label('template', 'Template:') !!}
    {!! Form::text('template', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
</div>

<!-- Template Url Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('template_url_description', 'Template Url Description:') !!}
    {!! Form::text('template_url_description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Lastupdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastupdate', 'Lastupdate:') !!}
    {!! Form::text('lastupdate', null, ['class' => 'form-control','id'=>'lastupdate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#lastupdate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Som Forms Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_forms_id', 'Som Forms Id:') !!}
    {!! Form::number('som_forms_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Elements Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_elements', 'Order Elements:') !!}
    {!! Form::number('order_elements', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Mandatory Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_mandatory', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_mandatory', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_mandatory', 'Is Mandatory', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Is Sub Element Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_sub_element', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_sub_element', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_sub_element', 'Is Sub Element', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Tooltip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tooltip', 'Tooltip:') !!}
    {!! Form::text('tooltip', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
</div>

<!-- Cms Privileges Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cms_privileges_role_id', 'Cms Privileges Role Id:') !!}
    {!! Form::number('cms_privileges_role_id', null, ['class' => 'form-control']) !!}
</div>