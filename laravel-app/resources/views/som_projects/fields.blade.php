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

<!-- Img Url Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('img_url', 'Img Url') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('img_url', null, ['class' => 'form-control','maxlength' => 2000,'maxlength' => 2000]) !!}
    </div>
</div>

<!-- Documentation Folder Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('documentation_folder', 'Documentation Folder') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('documentation_folder', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
    </div>
</div>

<!-- Som Status Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::Label('som_status_id', 'Som Status Id') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::select('som_status_id', $statusArray, $sel_status, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Description -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('sub_name', 'Sub Name') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('sub_name', null, ['class' => 'form-control','maxlength' => 1000,'maxlength' => 1000]) !!}
    </div>
</div>

<!-- Som Projects Airport Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_projects_airport_id', 'Som Projects Airport Id') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('som_projects_airport_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Som Country Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_country_id', 'Som Country Id') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('som_country_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Grantor Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('grantor', 'Grantor') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('grantor', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

<!-- Email Legal Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('email_legal', 'Email Legal') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('email_legal', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
    </div>
</div>

<!-- Email Finance Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('email_finance', 'Email Finance') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('email_finance', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
    </div>
</div>

<!-- Som Project Process Type Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_project_process_type_id', 'Som Project Process Type Id') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('som_project_process_type_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Som Projects Asset Type Id Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('som_projects_asset_type_id', 'Som Projects Asset Type Id') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('som_projects_asset_type_id', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Equity Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('equity', 'Equity') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('equity', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Percentage Participation Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('percentage_participation', 'Percentage Participation') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::number('percentage_participation', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Bid Presentation Date Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('bid_presentation_date', 'Bid Presentation Date') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('bid_presentation_date', null, ['class' => 'form-control','id'=>'bid_presentation_date']) !!}
    </div>
</div>

<!-- Concession Date Start Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('concession_date_start', 'Concession Date Start') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('concession_date_start', null, ['class' => 'form-control','id'=>'concession_date_start']) !!}
    </div>
</div>

<!-- Contract Scope Field -->
<div class="form-group row">
    <div class="col-sm-2 col-form-label text-right">
        {!! Form::label('contract_scope', 'Contract Scope') !!}
    </div>
    <div class="col-sm-10">
        {!! Form::text('contract_scope', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#concession_date_start').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('#bid_presentation_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

{{-- 

<!-- Pr Length Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pr_length', 'Pr Length:') !!}
    {!! Form::number('pr_length', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Template Project Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_template_project', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_template_project', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_template_project', 'Is Template Project', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Timeoffset Field -->
<div class="form-group col-sm-6">
    {!! Form::label('timeoffset', 'Timeoffset:') !!}
    {!! Form::number('timeoffset', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Awarded Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_awarded', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_awarded', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_awarded', 'Is Awarded', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Is Dismissed Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_dismissed', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_dismissed', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_dismissed', 'Is Dismissed', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Deal Rational Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deal_rational', 'Deal Rational:') !!}
    {!! Form::text('deal_rational', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Other Requirements Field -->
<div class="form-group col-sm-6">
    {!! Form::label('other_requirements', 'Other Requirements:') !!}
    {!! Form::text('other_requirements', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>

<!-- Valuation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valuation', 'Valuation:') !!}
    {!! Form::number('valuation', null, ['class' => 'form-control']) !!}
</div>

<!-- Solvency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solvency', 'Solvency:') !!}
    {!! Form::text('solvency', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>







<!-- Som Project Priority Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_project_priority_id', 'Som Project Priority Id:') !!}
    {!! Form::number('som_project_priority_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Project Info Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_project_info_status_id', 'Som Project Info Status Id:') !!}
    {!! Form::number('som_project_info_status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Som Projects Model Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('som_projects_model_id', 'Som Projects Model Id:') !!}
    {!! Form::number('som_projects_model_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Ev Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ev', 'Ev:') !!}
    {!! Form::text('ev', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
</div>

<!-- Responsibility Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsibility', 'Responsibility:') !!}
    {!! Form::text('responsibility', null, ['class' => 'form-control','maxlength' => 10,'maxlength' => 10]) !!}
</div>

 --}}
