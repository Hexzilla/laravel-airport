@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-search"></i> Add Users Departments</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> Users Departments
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-4 mb-4">
                <a href="{{ route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]) }}">
                    <i class="fa fa-chevron-circle-left"></i> Back To List Data Users Departments
                </a>
            </div>
        </div>

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'somDepartmentsUsers.store']) !!}

            <div class="card-header coh">
                <span><i class="fa fa-search ml-2"></i> Add Users Departments</span>
            </div>

            <div class="card-body">
                @include('som_departments_users.fields')
            </div>

            <div class="card-footer">
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <a href="{{ route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]) }}" class="btn btn-back"><i class="fa fa-chevron-circle-left"></i> Back</a>
                        {!! Form::submit('Save & Add More', ['class' => 'btn btn-black','name' => 'sub2']) !!}
                        {!! Form::submit('Save', ['class' => 'btn btn-black','name' => 'sub1']) !!}  
                    </div>
                </div>                                  
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
