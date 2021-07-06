<div class="table-responsive">
    <table class="table" id="somProjectsAdditionalAirports-table">
        <thead>
            <tr>
                <th>Airport</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsAdditionalAirports as $somProjectsAdditionalAirport)
            <tr>
                <td>{{ $somProjectsAdditionalAirport->somAirport->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsAdditionalAirports.destroy', $somProjectsAdditionalAirport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsAdditionalAirports.edit', [$somProjectsAdditionalAirport->id]) }}" class='btn btn-default btn-xs'>
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
