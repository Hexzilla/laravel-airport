<div class="table-responsive">
    <table class="table" id="somProjectsAdvisors-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Som Projects Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsAdvisors as $somProjectsAdvisors)
            <tr>
                <td>{{ $somProjectsAdvisors->name }}</td>
            <td>{{ $somProjectsAdvisors->som_projects_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsAdvisors.destroy', $somProjectsAdvisors->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsAdvisors.show', [$somProjectsAdvisors->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectsAdvisors.edit', [$somProjectsAdvisors->id]) }}" class='btn btn-default btn-xs'>
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
