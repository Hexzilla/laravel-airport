@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex;">
                    <h1><i class="fa fa-folder"></i> Departments</h1>
                    <a class="btn btn-black ml-3" 
                       href="{{ route('getLoad') }}" style="background-color:#07a2d8;">
                        <i class="fa fa-users" aria-hidden="true"></i>  Load Users from AD
                    </a>
                    <!-- <a class="btn btn-black ml-3" 
                       href="{{ route('somDepartments.create') }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Data
                    </a> -->
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> Departments
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            
            <div class="card-body p-0">
                @include('som_departments.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

