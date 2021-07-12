@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-right">
                    <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                    <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{ route('somNews.index') }}">News</a>
                    <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="javascript:void(0)">Add News</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="far fa-newspaper ml-2"></i> News</h5>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('somNews.index') }}">
                        <i class="fa fa-chevron-left"></i> Back To List Data News
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="card">
            {!! Form::open(['route' => 'somNews.store']) !!}

            <div class="card-header">
                <span><i class="far fa-newspaper ml-2"></i> Add News</span>
            </div>

            <div class="card-body">

                <div class="row">
                    @include('som_news.fields')
                </div>

            </div>

            <div class="card-footer">
                <a href="{{ route('somNews.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Back</a>
                <a href="#" class="btn btn-secondary">Save & Add More</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
