@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Som Projects Airport</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somAirports.index') }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Projects Airport
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somProjectsAirport, ['route' => ['somAirports.update', $somProjectsAirport->id],'enctype' =>'multipart/form-data', 'method' => 'patch']) !!}

            <div class="card-body">
                <!-- <div class="row"> -->
                    @include('som_projects_airports.fields')
                <!-- </div> -->
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somAirports.index') }}" class="btn btn-default">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
