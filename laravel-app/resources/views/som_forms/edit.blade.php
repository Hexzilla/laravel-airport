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
                        <a href="{{ route('somForms.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
