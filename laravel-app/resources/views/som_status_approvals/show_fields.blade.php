<!-- Som Status Id Field -->
<div class="col-sm-12">
    {!! Form::label('som_status_id', 'Som Status Id:') !!}
    <p>{{ $somStatusApprovals->som_status_id }}</p>
</div>

<!-- Som Approvals Responsible Id Field -->
<div class="col-sm-12">
    {!! Form::label('som_approvals_responsible_id', 'Som Approvals Responsible Id:') !!}
    <p>{{ $somStatusApprovals->som_approvals_responsible_id }}</p>
</div>

<!-- Status Order Field -->
<div class="col-sm-12">
    {!! Form::label('status_order', 'Status Order:') !!}
    <p>{{ $somStatusApprovals->status_order }}</p>
</div>

