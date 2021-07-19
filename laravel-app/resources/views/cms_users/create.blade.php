@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Cms Users</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('cmsUsers.index') }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Cms Users
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'cmsUsers.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('cms_users.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('cmsUsers.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
