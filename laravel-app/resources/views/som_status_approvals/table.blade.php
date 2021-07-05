<div class="table-responsive">
    <table class="table" id="somStatusApprovals-table">
        <thead>
            <tr>
                <th>Som Status Id</th>
        <th>Som Approvals Responsible Id</th>
        <th>Status Order</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somStatusApprovals as $somStatusApprovals)
            <tr>
                <td>{{ $somStatusApprovals->som_status_id }}</td>
            <td>{{ $somStatusApprovals->som_approvals_responsible_id }}</td>
            <td>{{ $somStatusApprovals->status_order }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somStatusApprovals.destroy', $somStatusApprovals->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somStatusApprovals.show', [$somStatusApprovals->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somStatusApprovals.edit', [$somStatusApprovals->id]) }}" class='btn btn-default btn-xs'>
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
