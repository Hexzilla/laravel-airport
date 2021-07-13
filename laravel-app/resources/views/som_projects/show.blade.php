@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Som Projects Details</h1>
                    <a class="btn btn-default float-right"
                       href="{{ route('somProjects.index') }}" style="color:blue;">
                       <i class="fa fa-chevron-left"></i> Back To List Data Projects
                    </a>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('som_projects.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
