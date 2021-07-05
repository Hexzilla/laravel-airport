<div class="table-responsive">
    <table class="table" id="somProjectsAirportTypes-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsAirportTypes as $somProjectsAirportType)
            <tr>
                <td>{{ $somProjectsAirportType->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsAirportTypes.destroy', $somProjectsAirportType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsAirportTypes.show', [$somProjectsAirportType->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectsAirportTypes.edit', [$somProjectsAirportType->id]) }}" class='btn btn-default btn-xs'>
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
