<div class="table-responsive">
    <table class="table" id="somFormApprovals-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Som Forms Id</th>
        <th>Order Approval</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somFormApprovals as $somFormApprovals)
            <tr>
                <td>{{ $somFormApprovals->name }}</td>
            <td>{{ $somFormApprovals->som_forms_id }}</td>
            <td>{{ $somFormApprovals->order_approval }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somFormApprovals.destroy', $somFormApprovals->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somFormApprovals.show', [$somFormApprovals->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somFormApprovals.edit', [$somFormApprovals->id]) }}" class='btn btn-default btn-xs'>
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
