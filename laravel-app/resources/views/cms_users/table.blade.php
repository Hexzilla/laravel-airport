<div class="table-responsive">
    <table class="table" id="cmsUsers-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Photo</th>
        <th>Email</th>
        <th>Password</th>
        <th>Id Cms Privileges</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Status</th>
        <th>Job Title</th>
        <th>Objectguid</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsUsers as $cmsUsers)
            <tr>
                <td>{{ $cmsUsers->name }}</td>
            <td>{{ $cmsUsers->photo }}</td>
            <td>{{ $cmsUsers->email }}</td>
            <td>{{ $cmsUsers->password }}</td>
            <td>{{ $cmsUsers->id_cms_privileges }}</td>
            <td>{{ $cmsUsers->created_at }}</td>
            <td>{{ $cmsUsers->updated_at }}</td>
            <td>{{ $cmsUsers->status }}</td>
            <td>{{ $cmsUsers->job_title }}</td>
            <td>{{ $cmsUsers->objectguid }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsUsers.destroy', $cmsUsers->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsUsers.show', [$cmsUsers->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsUsers.edit', [$cmsUsers->id]) }}" class='btn btn-default btn-xs'>
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
