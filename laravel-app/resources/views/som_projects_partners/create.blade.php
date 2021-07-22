@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Projects Partners</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somProjectsPartners.index',['project_id' => $somProjectID]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Projects Partners
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somProjectsPartners.store']) !!}

            <div class="card-body">
                @include('som_projects_partners.fields')
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="offset-sm-2 col-sm-10">                        
                        <a href="{{ route('somProjectsPartners.index',['project_id' => $somProjectID]) }}" class="btn btn-default">
                            Cancel
                        </a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>    
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
