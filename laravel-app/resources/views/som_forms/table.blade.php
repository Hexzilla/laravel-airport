<div class="table-responsive">
    <table class="table" id="somForms-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Active</th>
        <th>Som Phases Milestones Id</th>
        <th>Order Form</th>
        <th>Som Milestones Forms Types Id</th>
        <th>Som Status Id</th>
        <th>Is Inactive</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somForms as $somForms)
            <tr>
                <td>{{ $somForms->name }}</td>
            <td>{{ $somForms->active }}</td>
            <td>{{ $somForms->som_phases_milestones_id }}</td>
            <td>{{ $somForms->order_form }}</td>
            <td>{{ $somForms->som_milestones_forms_types_id }}</td>
            <td>{{ $somForms->som_status_id }}</td>
            <td>{{ $somForms->is_inactive }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somForms.destroy', $somForms->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    <a href="{{ route('somFormTasks.index', [$somForms->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-task"></i>tasks
                        </a>
                        <a href="{{ route('somFormElements.index', [$somForms->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-task"></i>elements
                        </a>
                        <a href="{{ route('somFormApprovals.index', [$somForms->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-task"></i>approvals
                        </a>
                        <a href="{{ route('somForms.show', [$somForms->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somForms.edit', [$somForms->id]) }}" class='btn btn-default btn-xs'>
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
