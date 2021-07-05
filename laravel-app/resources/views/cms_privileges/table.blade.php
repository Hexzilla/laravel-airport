<div class="table-responsive">
    <table class="table" id="cmsPrivileges-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Is Superadmin</th>
        <th>Theme Color</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Is App Role</th>
        <th>Is Project Role</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsPrivileges as $cmsPrivileges)
            <tr>
                <td>{{ $cmsPrivileges->name }}</td>
            <td>{{ $cmsPrivileges->is_superadmin }}</td>
            <td>{{ $cmsPrivileges->theme_color }}</td>
            <td>{{ $cmsPrivileges->created_at }}</td>
            <td>{{ $cmsPrivileges->updated_at }}</td>
            <td>{{ $cmsPrivileges->is_app_role }}</td>
            <td>{{ $cmsPrivileges->is_project_role }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsPrivileges.destroy', $cmsPrivileges->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsPrivileges.show', [$cmsPrivileges->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsPrivileges.edit', [$cmsPrivileges->id]) }}" class='btn btn-default btn-xs'>
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
