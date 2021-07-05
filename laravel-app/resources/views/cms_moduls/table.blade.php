<div class="table-responsive">
    <table class="table" id="cmsModuls-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Icon</th>
        <th>Path</th>
        <th>Table Name</th>
        <th>Controller</th>
        <th>Is Protected</th>
        <th>Is Active</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Deleted At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsModuls as $cmsModuls)
            <tr>
                <td>{{ $cmsModuls->name }}</td>
            <td>{{ $cmsModuls->icon }}</td>
            <td>{{ $cmsModuls->path }}</td>
            <td>{{ $cmsModuls->table_name }}</td>
            <td>{{ $cmsModuls->controller }}</td>
            <td>{{ $cmsModuls->is_protected }}</td>
            <td>{{ $cmsModuls->is_active }}</td>
            <td>{{ $cmsModuls->created_at }}</td>
            <td>{{ $cmsModuls->updated_at }}</td>
            <td>{{ $cmsModuls->deleted_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsModuls.destroy', $cmsModuls->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsModuls.show', [$cmsModuls->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsModuls.edit', [$cmsModuls->id]) }}" class='btn btn-default btn-xs'>
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
