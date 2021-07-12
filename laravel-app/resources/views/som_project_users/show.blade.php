@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 text-right">
                <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somProjects')}}">Project</a>
                <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somProjectUsers')}}">Som Project Users</a>
                <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="javascript:void(0)">Som Project Users Details</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5><i class="fa fa-user"></i> Som Project Users Details</h5>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-default float-right"
                       href="{{ route('somProjectUsers.index') }}">
                        Back
                    </a>
            </div>
        </div>
    </div>
</section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('som_project_users.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
