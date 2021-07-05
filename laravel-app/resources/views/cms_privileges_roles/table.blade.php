<div class="table-responsive">
    <table class="table" id="cmsPrivilegesRoles-table">
        <thead>
            <tr>
                <th>Is Visible</th>
        <th>Is Create</th>
        <th>Is Read</th>
        <th>Is Edit</th>
        <th>Is Delete</th>
        <th>Id Cms Privileges</th>
        <th>Id Cms Moduls</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsPrivilegesRoles as $cmsPrivilegesRoles)
            <tr>
                <td>{{ $cmsPrivilegesRoles->is_visible }}</td>
            <td>{{ $cmsPrivilegesRoles->is_create }}</td>
            <td>{{ $cmsPrivilegesRoles->is_read }}</td>
            <td>{{ $cmsPrivilegesRoles->is_edit }}</td>
            <td>{{ $cmsPrivilegesRoles->is_delete }}</td>
            <td>{{ $cmsPrivilegesRoles->id_cms_privileges }}</td>
            <td>{{ $cmsPrivilegesRoles->id_cms_moduls }}</td>
            <td>{{ $cmsPrivilegesRoles->created_at }}</td>
            <td>{{ $cmsPrivilegesRoles->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsPrivilegesRoles.destroy', $cmsPrivilegesRoles->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsPrivilegesRoles.show', [$cmsPrivilegesRoles->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsPrivilegesRoles.edit', [$cmsPrivilegesRoles->id]) }}" class='btn btn-default btn-xs'>
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
