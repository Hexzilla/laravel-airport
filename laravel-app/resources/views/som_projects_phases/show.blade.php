@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-glass-martini"></i> Som Projects Phases Details</h5>
                    <a class="btn btn-default" style="color:blue;"
                           href="{{ URL::previous() }}">
                           <i class="fa fa-chevron-left"></i> Back To List Data Projects Phases
                        </a>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12 text-right">
                        <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somProjects')}}">Project</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{ URL::previous() }}">Project Phases</a>
                        <i class="fa fa-angle-right" style="color: black;"></i>  Som Projects Phases Details
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('som_projects_phases.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
