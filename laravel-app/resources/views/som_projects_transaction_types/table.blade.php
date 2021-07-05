<div class="table-responsive">
    <table class="table" id="somProjectsTransactionTypes-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsTransactionTypes as $somProjectsTransactionType)
            <tr>
                <td>{{ $somProjectsTransactionType->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsTransactionTypes.destroy', $somProjectsTransactionType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsTransactionTypes.show', [$somProjectsTransactionType->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectsTransactionTypes.edit', [$somProjectsTransactionType->id]) }}" class='btn btn-default btn-xs'>
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
