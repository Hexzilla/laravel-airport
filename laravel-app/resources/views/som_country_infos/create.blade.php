@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><i class="fa fa-globe ml-2"></i> Add Country Info</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somCountryInfos.index',['somCountry_id'=> $somCountry_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Country Info
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somCountryInfos.store']) !!}

            <div class="card-header">
                <span><i class="fa fa-globe ml-2"></i> Add Country Info</span>
            </div>

            <div class="card-body">

                <!-- <div class="row"> -->
                    @include('som_country_infos.fields')
                <!-- </div> -->

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somCountryInfos.index',['somCountry_id'=> $somCountry_id]) }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
