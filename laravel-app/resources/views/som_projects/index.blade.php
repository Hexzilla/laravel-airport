@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-box"></i> Projects</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <a href="#">
                            <i class="fa fa-chevron-right"></i> Projects
                        </a>                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="row ml-1">
            <div class="col-md-6 mb-4">
                <a href="#">
                    <i class="fa fa-chevron-left"></i> Home
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a class="btn btn-primary float-right"
                   href="{{ route('somProjects.create') }}">
                    Add Project
                </a>
            </div>
        </div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <span><i class="fa fa-box ml-2"></i> Projects List</span>
                    </div>
                    <div class="col-md-9"></div>
                </div>
                
            </div>
            <div class="card-body p-0">
                @include('som_projects.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

