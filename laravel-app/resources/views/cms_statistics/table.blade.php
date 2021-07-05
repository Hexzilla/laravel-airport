<div class="table-responsive">
    <table class="table" id="cmsStatistics-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Slug</th>
        <th>Created At</th>
        <th>Updated At</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cmsStatistics as $cmsStatistics)
            <tr>
                <td>{{ $cmsStatistics->name }}</td>
            <td>{{ $cmsStatistics->slug }}</td>
            <td>{{ $cmsStatistics->created_at }}</td>
            <td>{{ $cmsStatistics->updated_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['cmsStatistics.destroy', $cmsStatistics->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('cmsStatistics.show', [$cmsStatistics->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('cmsStatistics.edit', [$cmsStatistics->id]) }}" class='btn btn-default btn-xs'>
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
