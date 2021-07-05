<div class="table-responsive">
    <table class="table" id="cmsApiKeys-table">
        <thead>
            <tr>
                <th>Screetkey</th>
        <th>Hit</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsApiKeys as $cmsApiKey)
            <tr>
                <td>{{ $cmsApiKey->screetkey }}</td>
            <td>{{ $cmsApiKey->hit }}</td>
            <td>{{ $cmsApiKey->status }}</td>
            <td>{{ $cmsApiKey->created_at }}</td>
            <td>{{ $cmsApiKey->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsApiKeys.destroy', $cmsApiKey->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsApiKeys.show', [$cmsApiKey->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsApiKeys.edit', [$cmsApiKey->id]) }}" class='btn btn-default btn-xs'>
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
