<div class="table-responsive">
    <table class="table" id="cmsMenusPrivileges-table">
        <thead>
            <tr>
                <th>Id Cms Menus</th>
        <th>Id Cms Privileges</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsMenusPrivileges as $cmsMenusPrivileges)
            <tr>
                <td>{{ $cmsMenusPrivileges->id_cms_menus }}</td>
            <td>{{ $cmsMenusPrivileges->id_cms_privileges }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsMenusPrivileges.destroy', $cmsMenusPrivileges->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsMenusPrivileges.show', [$cmsMenusPrivileges->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsMenusPrivileges.edit', [$cmsMenusPrivileges->id]) }}" class='btn btn-default btn-xs'>
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
