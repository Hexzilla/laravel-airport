<div class="table-responsive">
    <table class="table" id="somProjectsAirports-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>Country</th>
        <th>Lat</th>
        <th>Long</th>
        <th>Iata Oaci</th>
        <th>Som Projects Airport Type</th>
        <th>Size</th>
        <th>Revenues Aeronautical</th>
        <th>Revenues Non Aeronautical</th>
        <th>Total Revenues</th>
        <th>Total Opex</th>
        <th>Ebitda</th>
        <th>Kpi Revenues Aeronautical</th>
        <th>Kpi Revenues Non Aeronautical</th>
        <th>Kpi Ebitda</th>
        <th>Percentage International</th>
        <th>Percentage Transfer</th>
        <th>Percentage Non Low Cost</th>
        <th>Infrastructure Characterization Description</th>
        <th>Airport Catchment Area</th>
        <th>Competitors</th>
        <th>Top1 Airline</th>
        <th>Top2 Airline</th>
        <th>Top3 Airline</th>
        <th>Top1 Airline Percentage</th>
        <th>Top2 Airline Percentage</th>
        <th>Top3 Airline Percentage</th>
        <th>Route</th>
        <th>Master Plan Estimations</th>
        <th>Society Model Regulation</th>
        <th>Aena Network Improvement</th>
        <th>Debt Ebitda</th>
        <th>Img Url</th>
        <th>Som Country Id</th>
        <th>Other Info</th>
        <th>Data Year</th>
        <th>Version Date</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somProjectsAirports as $somProjectsAirport)
            <tr>
                <td>{{ $somProjectsAirport->name }}</td>
            <td>{{ $somProjectsAirport->address }}</td>
            <td>{{ $somProjectsAirport->city }}</td>
            <td>{{ $somProjectsAirport->country }}</td>
            <td>{{ $somProjectsAirport->lat }}</td>
            <td>{{ $somProjectsAirport->long }}</td>
            <td>{{ $somProjectsAirport->iata_oaci }}</td>            
            @if (!empty($somProjectsAirport->som_projects_airport_type_id))
                <td>{{ $data['airport_types'][$somProjectsAirport->som_projects_airport_type_id] }}</td>
            @else
                <td></td>
            @endif 
            <td>{{ $somProjectsAirport->size }}</td>
            <td>{{ $somProjectsAirport->revenues_aeronautical }}</td>
            <td>{{ $somProjectsAirport->revenues_non_aeronautical }}</td>
            <td>{{ $somProjectsAirport->total_revenues }}</td>
            <td>{{ $somProjectsAirport->total_opex }}</td>
            <td>{{ $somProjectsAirport->ebitda }}</td>
            <td>{{ $somProjectsAirport->kpi_revenues_aeronautical }}</td>
            <td>{{ $somProjectsAirport->kpi_revenues_non_aeronautical }}</td>
            <td>{{ $somProjectsAirport->kpi_ebitda }}</td>
            <td>{{ $somProjectsAirport->percentage_international }}</td>
            <td>{{ $somProjectsAirport->percentage_transfer }}</td>
            <td>{{ $somProjectsAirport->percentage_non_low_cost }}</td>
            <td>{{ $somProjectsAirport->infrastructure_characterization_description }}</td>
            <td>{{ $somProjectsAirport->airport_catchment_area }}</td>
            <td>{{ $somProjectsAirport->competitors }}</td>
            <td>{{ $somProjectsAirport->top1_airline }}</td>
            <td>{{ $somProjectsAirport->top2_airline }}</td>
            <td>{{ $somProjectsAirport->top3_airline }}</td>
            <td>{{ $somProjectsAirport->top1_airline_percentage }}</td>
            <td>{{ $somProjectsAirport->top2_airline_percentage }}</td>
            <td>{{ $somProjectsAirport->top3_airline_percentage }}</td>
            <td>{{ $somProjectsAirport->route }}</td>
            <td>{{ $somProjectsAirport->master_plan_estimations }}</td>
            <td>{{ $somProjectsAirport->society_model_regulation }}</td>
            <td>{{ $somProjectsAirport->aena_network_improvement }}</td>
            <td>{{ $somProjectsAirport->debt_ebitda }}</td>
            <td>{{ $somProjectsAirport->img_url }}</td>
            <td>{{ $somProjectsAirport->som_country_id }}</td>
            <td>{{ $somProjectsAirport->other_info }}</td>
            <td>{{ $somProjectsAirport->data_year }}</td>
            <td>{{ $somProjectsAirport->version_date }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['somAirports.destroy', $somProjectsAirport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somAirports.show', [$somProjectsAirport->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somAirports.edit', [$somProjectsAirport->id]) }}" class='btn btn-default btn-xs'>
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
