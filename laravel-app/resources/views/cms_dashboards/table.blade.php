<div class="table-responsive">
    <table class="table" id="cmsDashboards-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Id Cms Privileges</th>
        <th>Content</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsDashboards as $cmsDashboard)
            <tr>
                <td>{{ $cmsDashboard->name }}</td>
            <td>{{ $cmsDashboard->id_cms_privileges }}</td>
            <td>{{ $cmsDashboard->content }}</td>
            <td>{{ $cmsDashboard->created_at }}</td>
            <td>{{ $cmsDashboard->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsDashboards.destroy', $cmsDashboard->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsDashboards.show', [$cmsDashboard->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsDashboards.edit', [$cmsDashboard->id]) }}" class='btn btn-default btn-xs'>
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
