<div class="table-responsive">
    <table class="table table-striped table-bordered datatable" id="somProjectsPhases-table">
        <thead>
            <tr>
                <th>Phase</th>
                <th>Order</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsPhases as $somProjectsPhases)
            <tr>
                <td>{{ $somProjectsPhases->somPhases->name }}</td>
                <td>{{ $somProjectsPhases->order }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsPhases.destroy', $somProjectsPhases->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
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
