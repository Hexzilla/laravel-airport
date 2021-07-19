@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Cms Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row ml-1">
            <div class="col-md-12 mb-4">
                <a href="{{ route('cmsDashboards.index') }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Dashboard
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'cmsDashboards.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('cms_dashboards.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('cmsDashboards.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
