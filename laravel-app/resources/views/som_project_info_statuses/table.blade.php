<div class="table-responsive">
    <table class="table" id="somProjectInfoStatuses-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectInfoStatuses as $somProjectInfoStatus)
            <tr>
                <td>{{ $somProjectInfoStatus->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectInfoStatuses.destroy', $somProjectInfoStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectInfoStatuses.show', [$somProjectInfoStatus->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectInfoStatuses.edit', [$somProjectInfoStatus->id]) }}" class='btn btn-default btn-xs'>
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
