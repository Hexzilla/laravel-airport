@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Forms</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somForms.index',['milestones_id'=> $milestones_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Forms
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somForms, ['route' => ['somForms.update', $somForms->id], 'method' => 'patch']) !!}

            <div class="card-body">
                @include('som_forms.fields')
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="offset-sm-2 col-sm-10">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('somForms.index',['milestones_id'=> $milestones_id]) }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
