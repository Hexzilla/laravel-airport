<div class="table-responsive">
    <table class="table" id="cmsLogs-table">
        <thead>
            <tr>
                <th>Ipaddress</th>
        <th>Useragent</th>
        <th>Url</th>
        <th>Description</th>
        <th>Details</th>
        <th>Id Cms Users</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsLogs as $cmsLogs)
            <tr>
                <td>{{ $cmsLogs->ipaddress }}</td>
            <td>{{ $cmsLogs->useragent }}</td>
            <td>{{ $cmsLogs->url }}</td>
            <td>{{ $cmsLogs->description }}</td>
            <td>{{ $cmsLogs->details }}</td>
            <td>{{ $cmsLogs->id_cms_users }}</td>
            <td>{{ $cmsLogs->created_at }}</td>
            <td>{{ $cmsLogs->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsLogs.destroy', $cmsLogs->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsLogs.show', [$cmsLogs->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsLogs.edit', [$cmsLogs->id]) }}" class='btn btn-default btn-xs'>
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
