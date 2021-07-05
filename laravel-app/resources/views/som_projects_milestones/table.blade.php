<div class="table-responsive">
    <table class="table" id="somProjectsMilestones-table">
        <thead>
            <tr>
                <th>Som Projects Phases Id</th>
        <th>Blocking</th>
        <th>Order</th>
        <th>Due Date</th>
        <th>Name</th>
        <th>Som Status Id</th>
        <th>Is Hidden</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsMilestones as $somProjectsMilestones)
            <tr>
                <td>{{ $somProjectsMilestones->som_projects_phases_id }}</td>
            <td>{{ $somProjectsMilestones->blocking }}</td>
            <td>{{ $somProjectsMilestones->order }}</td>
            <td>{{ $somProjectsMilestones->due_date }}</td>
            <td>{{ $somProjectsMilestones->name }}</td>
            <td>{{ $somProjectsMilestones->som_status_id }}</td>
            <td>{{ $somProjectsMilestones->is_hidden }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsMilestones.destroy', $somProjectsMilestones->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsMilestones.show', [$somProjectsMilestones->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectsMilestones.edit', [$somProjectsMilestones->id]) }}" class='btn btn-default btn-xs'>
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
