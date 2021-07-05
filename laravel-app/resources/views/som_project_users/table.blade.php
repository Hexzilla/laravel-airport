<div class="table-responsive">
    <table class="table" id="somProjectUsers-table">
        <thead>
            <tr>
                <th>Som Projects Id</th>
        <th>Cms Users Id</th>
        <th>Cms Privileges Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectUsers as $somProjectUsers)
            <tr>
                <td>{{ $somProjectUsers->som_projects_id }}</td>
            <td>{{ $somProjectUsers->cms_users_id }}</td>
            <td>{{ $somProjectUsers->cms_privileges_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectUsers.destroy', $somProjectUsers->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectUsers.show', [$somProjectUsers->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectUsers.edit', [$somProjectUsers->id]) }}" class='btn btn-default btn-xs'>
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
