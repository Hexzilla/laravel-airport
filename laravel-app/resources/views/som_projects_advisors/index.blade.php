@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="display:flex;">
                    <h1><i class="fas fa-users"></i> Project Advisors</h1>
                    <a class="btn btn-black ml-3" 
                       href="{{ route('somProjectsAdvisors.create',['som_project_id' => $somProjectID]) }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Data
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <span>
                            <i class="fa fa-chevron-right"></i> Project Advisors
                        </span>                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row">
            <div class="col-12-lg ml-4 mb-4">
                <a href="{{ route('somProjects.index') }}">
                    <i class="fa fa-chevron-circle-left"></i> Back To List Data Projects
                </a>
            </div>
        </div> 

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3" >
                <div class="row">
                    <div class="col-md-3">
                        <span>Projects</span>
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
                @include('som_projects_advisors.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

