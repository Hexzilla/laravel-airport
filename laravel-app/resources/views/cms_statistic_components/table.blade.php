<div class="table-responsive">
    <table class="table" id="cmsStatisticComponents-table">
        <thead>
            <tr>
                <th>Id Cms Statistics</th>
        <th>Componentid</th>
        <th>Component Name</th>
        <th>Area Name</th>
        <th>Sorting</th>
        <th>Name</th>
        <th>Config</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsStatisticComponents as $cmsStatisticComponents)
            <tr>
                <td>{{ $cmsStatisticComponents->id_cms_statistics }}</td>
            <td>{{ $cmsStatisticComponents->componentID }}</td>
            <td>{{ $cmsStatisticComponents->component_name }}</td>
            <td>{{ $cmsStatisticComponents->area_name }}</td>
            <td>{{ $cmsStatisticComponents->sorting }}</td>
            <td>{{ $cmsStatisticComponents->name }}</td>
            <td>{{ $cmsStatisticComponents->config }}</td>
            <td>{{ $cmsStatisticComponents->created_at }}</td>
            <td>{{ $cmsStatisticComponents->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsStatisticComponents.destroy', $cmsStatisticComponents->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsStatisticComponents.show', [$cmsStatisticComponents->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsStatisticComponents.edit', [$cmsStatisticComponents->id]) }}" class='btn btn-default btn-xs'>
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
