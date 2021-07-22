@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex;">
                    <h1><i class="fa fa-search"></i> Users departments</h1>
                    <a class="btn btn-black ml-3" 
                       href="{{ route('somDepartmentsUsers.create',['som_departments_id'=> $som_departments_id]) }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Data
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> Users departments
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3"> 

        <div class="row">
            <div class="col-12-lg ml-4 mb-4">
                <a href="{{ route('somDepartments.index') }}">
                    <i class="fa fa-chevron-circle-left"></i> Back To List Data Departments
                </a>
            </div>
        </div>      

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3" >
                <div class="row">
                    <div class="col-md-3">
                        <span>Departments</span>
                    </div>
                    <div class="col-md-6 breadcrumbs-menu">
                        <span>{!! $breadcrumbs[0]['name'] !!}</span> 
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>

        <div class="card">
            
            <div class="card-body p-0">
                @include('som_departments_users.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

