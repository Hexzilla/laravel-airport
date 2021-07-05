<div class="table-responsive">
    <table class="table" id="somProjects-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Sub Name</th>
        <th>Grantor</th>
        <th>Concession Date Start</th>
        <th>Bid Presentation Date</th>
        <th>Equity</th>
        <th>Pr Length</th>
        <th>Is Template Project</th>
        <th>Timeoffset</th>
        <th>Is Awarded</th>
        <th>Is Dismissed</th>
        <th>Contract Scope</th>
        <th>Deal Rational</th>
        <th>Other Requirements</th>
        <th>Valuation</th>
        <th>Solvency</th>
        <th>Documentation Folder</th>
        <th>Som Status Id</th>
        <th>Som Project Process Type Id</th>
        <th>Som Project Priority Id</th>
        <th>Som Project Info Status Id</th>
        <th>Som Projects Model Id</th>
        <th>Som Projects Asset Type Id</th>
        <th>Som Projects Airport Id</th>
        <th>Som Country Id</th>
        <th>Percentage Participation</th>
        <th>Ev</th>
        <th>Duration</th>
        <th>Responsibility</th>
        <th>Email Legal</th>
        <th>Email Finance</th>
        <th>Img Url</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjects as $somProjects)
            <tr>
                <td>{{ $somProjects->name }}</td>
            <td>{{ $somProjects->sub_name }}</td>
            <td>{{ $somProjects->grantor }}</td>
            <td>{{ $somProjects->concession_date_start }}</td>
            <td>{{ $somProjects->bid_presentation_date }}</td>
            <td>{{ $somProjects->equity }}</td>
            <td>{{ $somProjects->pr_length }}</td>
            <td>{{ $somProjects->is_template_project }}</td>
            <td>{{ $somProjects->timeoffset }}</td>
            <td>{{ $somProjects->is_awarded }}</td>
            <td>{{ $somProjects->is_dismissed }}</td>
            <td>{{ $somProjects->contract_scope }}</td>
            <td>{{ $somProjects->deal_rational }}</td>
            <td>{{ $somProjects->other_requirements }}</td>
            <td>{{ $somProjects->valuation }}</td>
            <td>{{ $somProjects->solvency }}</td>
            <td>{{ $somProjects->documentation_folder }}</td>
            <td>{{ $somProjects->som_status_id }}</td>
            <td>{{ $somProjects->som_project_process_type_id }}</td>
            <td>{{ $somProjects->som_project_priority_id }}</td>
            <td>{{ $somProjects->som_project_info_status_id }}</td>
            <td>{{ $somProjects->som_projects_model_id }}</td>
            <td>{{ $somProjects->som_projects_asset_type_id }}</td>
            <td>{{ $somProjects->som_projects_airport_id }}</td>
            <td>{{ $somProjects->som_country_id }}</td>
            <td>{{ $somProjects->percentage_participation }}</td>
            <td>{{ $somProjects->ev }}</td>
            <td>{{ $somProjects->duration }}</td>
            <td>{{ $somProjects->responsibility }}</td>
            <td>{{ $somProjects->email_legal }}</td>
            <td>{{ $somProjects->email_finance }}</td>
            <td>{{ $somProjects->img_url }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somProjects.destroy', $somProjects->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjects.show', [$somProjects->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somProjects.edit', [$somProjects->id]) }}" class='btn btn-default btn-xs'>
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
