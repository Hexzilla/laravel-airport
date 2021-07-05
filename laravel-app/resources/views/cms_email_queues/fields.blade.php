<!-- Send At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('send_at', 'Send At:') !!}
    {!! Form::text('send_at', null, ['class' => 'form-control','id'=>'send_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#send_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Email Recipient Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_recipient', 'Email Recipient:') !!}
    {!! Form::text('email_recipient', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email From Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_from_email', 'Email From Email:') !!}
    {!! Form::text('email_from_email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email From Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_from_name', 'Email From Name:') !!}
    {!! Form::text('email_from_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Cc Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_cc_email', 'Email Cc Email:') !!}
    {!! Form::text('email_cc_email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_subject', 'Email Subject:') !!}
    {!! Form::text('email_subject', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('email_content', 'Email Content:') !!}
    {!! Form::textarea('email_content', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Attachments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('email_attachments', 'Email Attachments:') !!}
    {!! Form::textarea('email_attachments', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Sent Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_sent', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_sent', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_sent', 'Is Sent', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Created At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::text('created_at', null, ['class' => 'form-control','id'=>'created_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#created_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::text('updated_at', null, ['class' => 'form-control','id'=>'updated_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#updated_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush