<div class="table-responsive">
    <table class="table" id="cmsMenuses-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Type</th>
        <th>Path</th>
        <th>Color</th>
        <th>Icon</th>
        <th>Parent Id</th>
        <th>Is Active</th>
        <th>Is Dashboard</th>
        <th>Id Cms Privileges</th>
        <th>Sorting</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsMenuses as $cmsMenus)
            <tr>
                <td>{{ $cmsMenus->name }}</td>
            <td>{{ $cmsMenus->type }}</td>
            <td>{{ $cmsMenus->path }}</td>
            <td>{{ $cmsMenus->color }}</td>
            <td>{{ $cmsMenus->icon }}</td>
            <td>{{ $cmsMenus->parent_id }}</td>
            <td>{{ $cmsMenus->is_active }}</td>
            <td>{{ $cmsMenus->is_dashboard }}</td>
            <td>{{ $cmsMenus->id_cms_privileges }}</td>
            <td>{{ $cmsMenus->sorting }}</td>
            <td>{{ $cmsMenus->created_at }}</td>
            <td>{{ $cmsMenus->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsMenuses.destroy', $cmsMenus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsMenuses.show', [$cmsMenus->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsMenuses.edit', [$cmsMenus->id]) }}" class='btn btn-default btn-xs'>
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
