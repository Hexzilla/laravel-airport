@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Som Projects Additional Airport</h1>
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
