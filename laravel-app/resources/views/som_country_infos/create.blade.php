@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fa fa-info"></i> Create Som Country Info</h5>
                    <a class="btn btn-default"
                           href="{{url('somCountryInfos')}}" style="color: blue;">
                           <i class="fa fa-chevron-left"></i> Back To List Data Country Info
                        </a>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12 text-right">
                        <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somCountryInfos')}}">Country Info</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i> Create Som Country Info
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somCountryInfos.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('som_country_infos.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somCountryInfos.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
