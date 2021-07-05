<div class="table-responsive">
    <table class="table" id="somProjectsPhases-table">
        <thead>
            <tr>
                <th>Som Projects Id</th>
        <th>Som Phases Id</th>
        <th>Order</th>
        <th>Som Status Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsPhases as $somProjectsPhases)
            <tr>
                <td>{{ $somProjectsPhases->som_projects_id }}</td>
            <td>{{ $somProjectsPhases->som_phases_id }}</td>
            <td>{{ $somProjectsPhases->order }}</td>
            <td>{{ $somProjectsPhases->som_status_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsPhases.destroy', $somProjectsPhases->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsPhases.show', [$somProjectsPhases->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectsPhases.edit', [$somProjectsPhases->id]) }}" class='btn btn-default btn-xs'>
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
