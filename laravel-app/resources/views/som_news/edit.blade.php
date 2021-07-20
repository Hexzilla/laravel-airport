@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1><i class="far fa-newspaper ml-2"></i> Edit News</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-2 mb-4">
                <a href="{{ route('somNews.index') }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data News
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')
        <div class="card">

            <div class="card-header">
                <span><i class="far fa-newspaper ml-2"></i> Edit News</span>
            </div>

            {!! Form::model($somNews, ['route' => ['somNews.update', $somNews->id], 'method' => 'patch']) !!}

            <div class="card-body">
                @include('som_news.fields')
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="offset-sm-2 col-sm-10">
                        <a href="{{ route('somNews.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                </div>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
