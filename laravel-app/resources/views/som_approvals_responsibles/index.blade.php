@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class='fa fa-users'></i> Som Approvals Responsibles</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <a href="#">
                            <i class="fa fa-chevron-right"></i> Approvals Responsibles
                        </a>                        
                    </div>                        
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row ml-1">
            <div class="col-md-6 mb-4">
                <a href="{{ route('somFormApprovals.index', ['somforms_id'=>$breadcrumbs[3]['id'] ]) }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Form Approvals
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a class="btn btn-primary float-right"
                    href="{{ route('somApprovalsResponsibles.create', ['som_form_approvals_id'=>$som_form_approvals_id]) }}">
                        Add New
                </a>
            </div>
        </div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-3" >
                <div class="row">
                    <div class="col-md-1">
                        <span>Approvals</span>
                    </div>
                    <div class="col-md-8 breadcrumbs-menu">
                        <a href="{{ route('somProjectsPhases.index' , [ 'project_id'=>$breadcrumbs[0]['id'] ]) }}">
                            {!! $breadcrumbs[0]['name'] !!}
                        </a>  /
                        <a href="{{ route('somProjectsMilestones.index' , ['phases_id'=>$breadcrumbs[1]['id'] ]) }}">
                            {!! $breadcrumbs[1]['name'] !!}
                        </a>  / 
                        <a href="{{ route('somForms.index', ['milestones_id'=>$breadcrumbs[2]['id'] ]) }}">
                            {!! $breadcrumbs[2]['name'] !!}
                        </a>  /
                        <a href="{{ route('somFormApprovals.index', ['somforms_id'=>$breadcrumbs[3]['id'] ]) }}">
                            {!! $breadcrumbs[3]['name'] !!}
                        </a>  /  
                        <span>{!! $breadcrumbs[4]['name'] !!}</span>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                @include('som_approvals_responsibles.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

