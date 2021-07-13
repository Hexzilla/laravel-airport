<div class="table-responsive">
    <table class="table" id="somFormTasks-table">
        <thead>
            <tr>
                <th class="w-50">Task</th>
                <th>Department</th>
                <th>Order</th>
                <th>Tooltip</th>
                <th>Type</th>
                {{--<th>Task Completion Date</th>--}}
                {{--<th>Comment</th>--}}
                {{--<th>Support Doc Url</th>--}}
                {{--<th>Support Doc Description</th>--}}
                {{--<th>Som Status Id</th>--}}
                {{--<th>Som Forms Id</th>--}}
                {{--<th>Som Departments Users Id</th>--}}
                {{--<th>Som Departments Id</th>--}}
                {{--<th>Is Sub Task</th>--}}
                {{--<th>Cms Users Id</th>--}}
                {{--<th>Cms Privileges Role Id</th>--}}
                {{--<th>Consultable User Name</th>--}}
                {{--<th>Consultable User Email</th>--}}
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somFormTasks as $somFormTasks)
            <tr>
                <td>{{ $somFormTasks->name }}</td>
                <td>{{ $somFormTasks->som_departments_id }}</td>
                <td>{{ $somFormTasks->order }}</td>
                <td>{{ $somFormTasks->tooltip }}</td>
                <td>{{ $somFormTasks->is_sub_task }}</td>
                {{--<td>{{ $somFormTasks->task_completion_date }}</td>--}}
                {{--<td>{{ $somFormTasks->request_date }}</td>--}}
                {{--<td>{{ $somFormTasks->comment }}</td>--}}
                {{--<td>{{ $somFormTasks->support_doc_url }}</td>--}}
                {{--<td>{{ $somFormTasks->support_doc_description }}</td>--}}
                {{--<td>{{ $somFormTasks->som_status_id }}</td>--}}
                {{--<td>{{ $somFormTasks->som_forms_id }}</td>--}}
                {{--<td>{{ $somFormTasks->som_departments_users_id }}</td>--}}
                {{--<td>{{ $somFormTasks->som_departments_id }}</td>--}}
                {{--<td>{{ $somFormTasks->cms_users_id }}</td>--}}
                {{--<td>{{ $somFormTasks->cms_privileges_role_id }}</td>--}}
                {{--<td>{{ $somFormTasks->consultable_user_name }}</td>--}}
                {{--<td>{{ $somFormTasks->consultable_user_email }}</td>--}}
                <td width="120">
                    {!! Form::open(['route' => ['somFormTasks.destroy', $somFormTasks->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somFormTasks.show', [$somFormTasks->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somFormTasks.edit', [$somFormTasks->id]) }}" class='btn btn-default btn-xs'>
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
