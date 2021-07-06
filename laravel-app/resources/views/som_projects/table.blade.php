<div class="table-responsive">
    <table class="table" id="somProjects-table">
        <thead>
            <tr>
                <th>Master</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Transactio Type</th>
                <th>Asset Type</th>
                <th>Location</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjects as $somProjects)
            <tr>
                <td>@if ($somProjects->is_template_project)
                    <i class="fas fa-key"></i>
                    <!--Project Template-->
                    @endif
                </td>
                <td><img src="{{ $somProjects->img_url }}" alt="{{ $somProjects->name }}">
                    <!--Image-->
                </td>
                <td>{{ $somProjects->name }}
                    <!--Name-->
                </td>
                <td>{{ $somProjects->sub_name }}
                    <!--Description-->
                </td>
                <td>{{ $somProjects->somProjectsModel->name }}
                    <!--Transactio Type-->
                </td>
                <td>{{ ($somProjects->somProjectProcessType == null) ? '' : $somProjects->somProjectProcessType->name }}
                    <!--Asset Type-->
                </td>
                <td>{{ $somProjects->somCountry->country }}
                    <!--Location-->
                </td>
                <td>{{ ($somProjects->somProjectInfoStatus == null) ? '' : $somProjects->somProjectInfoStatus->name }}
                    <!--Status-->
                </td>

                <td width="120">
                    {!! Form::open(['route' => ['somProjects.destroy', $somProjects->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somProjectUsers.index', ['project_id' => $somProjects->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="fas fa-users"></i>Users
                        </a>
                        <a href="{{ route('somProjectsAdditionalAirports.index', ['project_id' => $somProjects->id]) }}"
                            class='btn btn-default btn-xs'>
                            <i class="fas fa-plane"></i>Additional Airports
                        </a>
                        <a href="{{ route('somProjectsPhases.index', ['project_id' => $somProjects->id]) }}" class='btn btn-default btn-xs'>
                            <i class="fas fa-film"></i>Phases
                        </a>
                        <a href="{{ route('somProjectsPartners.index', ['project_id' => $somProjects->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-object-group"></i>Partners
                        </a>
                        <a href="{{ route('somProjectsAdvisors.index', ['project_id' => $somProjects->id]) }}" class='btn btn-default btn-xs'>
                            <i class="fas fa-users"></i>Advisors
                        </a>

                        {{-- <a href="{{ route('somProjects.show', [$somProjects->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> --}}
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
