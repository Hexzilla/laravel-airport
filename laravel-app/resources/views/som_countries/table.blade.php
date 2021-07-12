<div class="table-responsive">
    <table class="table table-striped table-bordered datatable" id="somCountries-table">
        <thead>
            <tr>
                <th>Country</th>
                <th>Country Code</th>
                <th>Description</th>
                <th>Politics</th>
                <th>Regulatory</th>
                <th>Corruption</th>
                <th>Business Easyness</th>
                <th>Spain Affinity</th>
                <th>Aena Strategy Align</th>
                <th>Tourism Activity</th>
                <th>Country Risk</th>
                <th>Imports Exports</th>
                <th>Version Date</th>
                <th>Exchange Rate</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($somCountries as $somCountry)
            <tr>
                <td>{{ $somCountry->country }}</td>
            <td>{{ $somCountry->country_code }}</td>
            <td>
                @if($somCountry->description)
                {{ substr($somCountry->description,0,20) }}...
                @endif
            </td>
            <td>{{ $somCountry->politics }}</td>
            <td>{{ $somCountry->regulatory }}</td>
            <td>{{ $somCountry->corruption }}</td>
            <td>{{ $somCountry->business_easyness }}</td>
            <td>{{ $somCountry->spain_affinity }}</td>
            <td>{{ $somCountry->aena_strategy_align }}</td>
            <td>{{ $somCountry->tourism_activity }}</td>
            <td>{{ $somCountry->country_risk }}</td>
            <td>{{ $somCountry->imports_exports }}</td>
            <td>{{ $somCountry->version_date }}</td>
            <td>
                @if($somCountry->exchange_rate)
                {{ substr($somCountry->exchange_rate,0,20) }}...
                @endif
            </td>
                <td width="120">
                    {!! Form::open(['route' => ['somCountries.destroy', $somCountry->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('somCountries.show', [$somCountry->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('somCountries.edit', [$somCountry->id]) }}" class='btn btn-default btn-xs'>
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
