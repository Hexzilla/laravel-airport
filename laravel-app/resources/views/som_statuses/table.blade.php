<div class="table-responsive">
    <table class="table" id="somStatuses-table">
        <thead>
            <tr>
                <th>Hex Color</th>
        <th>Name</th>
        <th>Type</th>
        <th>Icon</th>
        <th>Display Text</th>
        <th>Is Behaviour Completed</th>
        <th>Is Behaviour Rejected</th>
        <th>Is Behaviour Ongoing</th>
        <th>Is Behaviour Review</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somStatuses as $somStatus)
            <tr>
                <td>{{ $somStatus->hex_color }}</td>
            <td>{{ $somStatus->name }}</td>
            <td>{{ $somStatus->type }}</td>
            <td>{{ $somStatus->icon }}</td>
            <td>{{ $somStatus->display_text }}</td>
            <td>{{ $somStatus->is_behaviour_completed }}</td>
            <td>{{ $somStatus->is_behaviour_rejected }}</td>
            <td>{{ $somStatus->is_behaviour_ongoing }}</td>
            <td>{{ $somStatus->is_behaviour_review }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somStatuses.destroy', $somStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somStatuses.show', [$somStatus->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somStatuses.edit', [$somStatus->id]) }}" class='btn btn-default btn-xs'>
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
