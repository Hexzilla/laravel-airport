@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Som Approvals Responsible</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Approvals Responsible
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somApprovalsResponsibles.store']) !!}

            <div class="card-body">

                @include('som_approvals_responsibles.fields')

            </div>

            <div class="card-footer">                
                <a href="{{ route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]) }}" class="btn btn-default">Cancel</a>
                {!! Form::submit('Save & Add More', ['class' => 'btn btn-secondary','name' => 'sub2']) !!}
                {!! Form::submit('Save', ['class' => 'btn btn-primary','name' => 'sub1']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
