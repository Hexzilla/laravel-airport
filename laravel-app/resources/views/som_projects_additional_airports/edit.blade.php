@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-plane-departure"></i> Edit Additional Airports</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> Additional Airports
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-4 mb-4">
                <a href="{{ route('somProjectsAdditionalAirports.index', ['project_id' => $somProjectsId]) }}">
                    <i class="fa fa-chevron-circle-left"></i> Back To List Data Additional Airports
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somProjectsAdditionalAirport, ['route' => ['somProjectsAdditionalAirports.update', $somProjectsAdditionalAirport->id], 'method' => 'patch']) !!}

            <div class="card-header coh">
                <span><i class="fas fa-plane-departure ml-2"></i> Edit Additional Airports</span>
            </div>

            <div class="card-body">
                    @include('som_projects_additional_airports.fields')
            </div>

            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <a href="{{ route('somProjectsAdditionalAirports.index', ['project_id' => $somProjectsId]) }}" class="btn btn-back"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-black']) !!}  
                    </div>
                </div>                                  
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
