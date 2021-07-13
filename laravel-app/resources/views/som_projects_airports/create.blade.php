@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><i class="fa fa-fighter-jet ml-2"></i> Add Airport</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somProjectsAirports.store','enctype' =>'multipart/form-data']) !!}

            <div class="card-header">
                <span><i class="fa fa-fighter-jet ml-2"></i> Add Airport</span>
            </div>

            <div class="card-body">

                <!-- <div class="row"> -->
                    @include('som_projects_airports.fields')
                <!-- </div> -->

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somProjectsAirports.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
