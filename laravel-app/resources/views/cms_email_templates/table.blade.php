<div class="table-responsive">
    <table class="table" id="cmsEmailTemplates-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Slug</th>
        <th>Subject</th>
        <th>Content</th>
        <th>Description</th>
        <th>From Name</th>
        <th>From Email</th>
        <th>Cc Email</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsEmailTemplates as $cmsEmailTemplates)
            <tr>
                <td>{{ $cmsEmailTemplates->name }}</td>
            <td>{{ $cmsEmailTemplates->slug }}</td>
            <td>{{ $cmsEmailTemplates->subject }}</td>
            <td>{{ $cmsEmailTemplates->content }}</td>
            <td>{{ $cmsEmailTemplates->description }}</td>
            <td>{{ $cmsEmailTemplates->from_name }}</td>
            <td>{{ $cmsEmailTemplates->from_email }}</td>
            <td>{{ $cmsEmailTemplates->cc_email }}</td>
            <td>{{ $cmsEmailTemplates->created_at }}</td>
            <td>{{ $cmsEmailTemplates->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsEmailTemplates.destroy', $cmsEmailTemplates->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsEmailTemplates.show', [$cmsEmailTemplates->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsEmailTemplates.edit', [$cmsEmailTemplates->id]) }}" class='btn btn-default btn-xs'>
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
