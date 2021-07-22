@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-palette"></i> Add Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> Dashboard
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-4 mb-4">
                <a href="{{ route('cmsDashboards.index') }}">
                    <i class="fa fa-chevron-circle-left"></i> Back To List Data Dashboard
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'cmsDashboards.store']) !!}

            <div class="card-header coh">
                <span><i class="fa fa-palette ml-2"></i> Add Dashboard</span>
            </div>

            <div class="card-body">
                @include('cms_dashboards.fields')                
            </div>

            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <a href="{{ route('cmsDashboards.index') }}" class="btn btn-back"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-black']) !!}  
                    </div>
                </div>                                  
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
