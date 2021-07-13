@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-plane-departure"></i> Edit Som Projects Additional Airport</h5>
                    <a class="btn btn-default" style="color:blue;"
                           href="{{ URL::previous() }}">
                           <i class="fa fa-chevron-left"></i> Back To List Data Additional Airport
                        </a>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12 text-right">
                        <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somProjects')}}">Project</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{ URL::previous() }}">Additional Airports</a>
                        <i class="fa fa-angle-right" style="color: black;"></i> Edit Projects Additional Airport
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somProjectsAdditionalAirport, ['route' => ['somProjectsAdditionalAirports.update', $somProjectsAdditionalAirport->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('som_projects_additional_airports.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somProjectsAdditionalAirports.index') }}" class="btn btn-default">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
