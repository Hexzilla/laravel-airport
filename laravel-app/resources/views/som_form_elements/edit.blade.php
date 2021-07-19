@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Som Form Elements</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somFormElements.index',['somforms_id'=>$somforms_id]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Forms Elements
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somFormElements, ['route' => ['somFormElements.update', $somFormElements->id], 'method' => 'patch']) !!}

            <div class="card-body">
                    @include('som_form_elements.fields')
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somFormElements.index',['somforms_id'=>$somforms_id]) }}" class="btn btn-default">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
