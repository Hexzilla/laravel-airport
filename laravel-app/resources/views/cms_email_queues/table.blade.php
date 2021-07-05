<div class="table-responsive">
    <table class="table" id="cmsEmailQueues-table">
        <thead>
            <tr>
                <th>Send At</th>
        <th>Email Recipient</th>
        <th>Email From Email</th>
        <th>Email From Name</th>
        <th>Email Cc Email</th>
        <th>Email Subject</th>
        <th>Email Content</th>
        <th>Email Attachments</th>
        <th>Is Sent</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsEmailQueues as $cmsEmailQueues)
            <tr>
                <td>{{ $cmsEmailQueues->send_at }}</td>
            <td>{{ $cmsEmailQueues->email_recipient }}</td>
            <td>{{ $cmsEmailQueues->email_from_email }}</td>
            <td>{{ $cmsEmailQueues->email_from_name }}</td>
            <td>{{ $cmsEmailQueues->email_cc_email }}</td>
            <td>{{ $cmsEmailQueues->email_subject }}</td>
            <td>{{ $cmsEmailQueues->email_content }}</td>
            <td>{{ $cmsEmailQueues->email_attachments }}</td>
            <td>{{ $cmsEmailQueues->is_sent }}</td>
            <td>{{ $cmsEmailQueues->created_at }}</td>
            <td>{{ $cmsEmailQueues->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsEmailQueues.destroy', $cmsEmailQueues->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsEmailQueues.show', [$cmsEmailQueues->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsEmailQueues.edit', [$cmsEmailQueues->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
