@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Som Status Approvals</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Status Approvals
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somStatusApprovals.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('som_status_approvals.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]) }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
