<div class="table-responsive">
    <table class="table" id="somProjectsPartners-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Som Projects Id</th>
        <th>Company</th>
        <th>Company Profile</th>
        <th>Role In Project</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Other Information</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsPartners as $somProjectsPartners)
            <tr>
                <td>{{ $somProjectsPartners->name }}</td>
            <td>{{ $somProjectsPartners->som_projects_id }}</td>
            <td>{{ $somProjectsPartners->company }}</td>
            <td>{{ $somProjectsPartners->company_profile }}</td>
            <td>{{ $somProjectsPartners->role_in_project }}</td>
            <td>{{ $somProjectsPartners->email }}</td>
            <td>{{ $somProjectsPartners->phone_number }}</td>
            <td>{{ $somProjectsPartners->other_information }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjectsPartners.destroy', $somProjectsPartners->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectsPartners.show', [$somProjectsPartners->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjectsPartners.edit', [$somProjectsPartners->id]) }}" class='btn btn-default btn-xs'>
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
