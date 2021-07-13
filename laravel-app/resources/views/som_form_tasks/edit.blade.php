@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Som Form Tasks</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somFormTasks.index',['somforms_id'=>$somFormTasks->som_forms_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Form Tasks
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somFormTasks, ['route' => ['somFormTasks.update', $somFormTasks->id], 'method' => 'patch']) !!}

            <div class="card-body">
                    @include('som_form_tasks.fields')
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="offset-sm-2 col-sm-10">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('somFormTasks.index',['somforms_id'=>$somFormTasks->som_forms_id]) }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
