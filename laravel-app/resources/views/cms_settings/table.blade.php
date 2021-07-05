<div class="table-responsive">
    <table class="table" id="cmsSettings-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Content</th>
        <th>Content Input Type</th>
        <th>Dataenum</th>
        <th>Helper</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Group Setting</th>
        <th>Label</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsSettings as $cmsSettings)
            <tr>
                <td>{{ $cmsSettings->name }}</td>
            <td>{{ $cmsSettings->content }}</td>
            <td>{{ $cmsSettings->content_input_type }}</td>
            <td>{{ $cmsSettings->dataenum }}</td>
            <td>{{ $cmsSettings->helper }}</td>
            <td>{{ $cmsSettings->created_at }}</td>
            <td>{{ $cmsSettings->updated_at }}</td>
            <td>{{ $cmsSettings->group_setting }}</td>
            <td>{{ $cmsSettings->label }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsSettings.destroy', $cmsSettings->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsSettings.show', [$cmsSettings->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsSettings.edit', [$cmsSettings->id]) }}" class='btn btn-default btn-xs'>
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
