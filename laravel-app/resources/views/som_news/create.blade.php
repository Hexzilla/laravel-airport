@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="far fa-newspaper"></i> Add News</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> News
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-4 mb-4">
                <a href="{{ route('somNews.index') }}">
                    <i class="fa fa-chevron-circle-left"></i> Back To List Data News
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somNews.store', 'id' => 'formCreate']) !!}

            <div class="card-header coh">
                <span><i class="far fa-newspaper ml-2"></i> Add News</span>
            </div>

            <div class="card-body">
                @include('som_news.fields')
            </div>

            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <a href="{{ route('somNews.index') }}" class="btn btn-back"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        {!! Form::submit('Save & Add More', ['class' => 'btn btn-black','name' => 'sub2']) !!}
                        {!! Form::submit('Save', ['class' => 'btn btn-black','name' => 'sub1']) !!}  
                    </div>
                </div>                                  
            </div>

            {!! Form::close() !!}

        </div>
    </div>    
@endsection
