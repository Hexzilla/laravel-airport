@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Form Approvals</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somFormApprovals.index', ['somforms_id'=>$somforms_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Form Approvals
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somFormApprovals.store']) !!}

            <div class="card-body">

                @include('som_form_approvals.fields')

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="offset-sm-2 col-sm-10">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('somFormApprovals.index', ['somforms_id'=>$somforms_id]) }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
