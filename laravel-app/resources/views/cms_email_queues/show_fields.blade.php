<!-- Send At Field -->
<div class="col-sm-12">
    {!! Form::label('send_at', 'Send At:') !!}
    <p>{{ $cmsEmailQueues->send_at }}</p>
</div>

<!-- Email Recipient Field -->
<div class="col-sm-12">
    {!! Form::label('email_recipient', 'Email Recipient:') !!}
    <p>{{ $cmsEmailQueues->email_recipient }}</p>
</div>

<!-- Email From Email Field -->
<div class="col-sm-12">
    {!! Form::label('email_from_email', 'Email From Email:') !!}
    <p>{{ $cmsEmailQueues->email_from_email }}</p>
</div>

<!-- Email From Name Field -->
<div class="col-sm-12">
    {!! Form::label('email_from_name', 'Email From Name:') !!}
    <p>{{ $cmsEmailQueues->email_from_name }}</p>
</div>

<!-- Email Cc Email Field -->
<div class="col-sm-12">
    {!! Form::label('email_cc_email', 'Email Cc Email:') !!}
    <p>{{ $cmsEmailQueues->email_cc_email }}</p>
</div>

<!-- Email Subject Field -->
<div class="col-sm-12">
    {!! Form::label('email_subject', 'Email Subject:') !!}
    <p>{{ $cmsEmailQueues->email_subject }}</p>
</div>

<!-- Email Content Field -->
<div class="col-sm-12">
    {!! Form::label('email_content', 'Email Content:') !!}
    <p>{{ $cmsEmailQueues->email_content }}</p>
</div>

<!-- Email Attachments Field -->
<div class="col-sm-12">
    {!! Form::label('email_attachments', 'Email Attachments:') !!}
    <p>{{ $cmsEmailQueues->email_attachments }}</p>
</div>

<!-- Is Sent Field -->
<div class="col-sm-12">
    {!! Form::label('is_sent', 'Is Sent:') !!}
    <p>{{ $cmsEmailQueues->is_sent }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $cmsEmailQueues->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $cmsEmailQueues->updated_at }}</p>
</div>

