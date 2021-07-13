@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="far fa-newspaper ml-2"></i> Edit News</h5>
                    <a href="{{ route('somNews.index') }}" style="color: blue;">
                        <i class="fa fa-chevron-left"></i> Back To List Data News
                    </a>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="col-sm-12 text-right">
                        <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{ route('somNews.index') }}">News</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i> Edit News
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="card">

            <div class="card-header">
                <span><i class="far fa-newspaper ml-2"></i> Edit News</span>
            </div>
            {!! Form::model($somNews, ['route' => ['somNews.update', $somNews->id], 'method' => 'patch','class'=>'formValidate']) !!}
            <div class="card-body">
                <div class="row">
                    @include('som_news.fields')
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('somNews.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
