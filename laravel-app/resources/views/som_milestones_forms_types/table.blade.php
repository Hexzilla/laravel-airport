<div class="table-responsive">
    <table class="table" id="somMilestonesFormsTypes-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somMilestonesFormsTypes as $somMilestonesFormsTypes)
            <tr>
                <td>{{ $somMilestonesFormsTypes->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somMilestonesFormsTypes.destroy', $somMilestonesFormsTypes->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somMilestonesFormsTypes.show', [$somMilestonesFormsTypes->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somMilestonesFormsTypes.edit', [$somMilestonesFormsTypes->id]) }}" class='btn btn-default btn-xs'>
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
