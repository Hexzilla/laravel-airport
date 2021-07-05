<div class="table-responsive">
    <table class="table" id="somDepartmentsUsers-table">
        <thead>
            <tr>
                <th>Som Departments Id</th>
        <th>Cms Users Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somDepartmentsUsers as $somDepartmentsUsers)
            <tr>
                <td>{{ $somDepartmentsUsers->som_departments_id }}</td>
            <td>{{ $somDepartmentsUsers->cms_users_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somDepartmentsUsers.destroy', $somDepartmentsUsers->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somDepartmentsUsers.show', [$somDepartmentsUsers->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somDepartmentsUsers.edit', [$somDepartmentsUsers->id]) }}" class='btn btn-default btn-xs'>
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
