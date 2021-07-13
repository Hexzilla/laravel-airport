@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fa fa-folder"></i> View Som Departments</h5>
                    <a class="btn btn-default"
                           href="{{url('somDepartments')}}" style="color:blue;">
                           <i class="fa fa-chevron-left"></i> Back To List Data Departments
                        </a>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12 text-right">
                        <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somDepartments')}}">Som Departments</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i> View Som Departments
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            <div class="card-body">
                <div class="row">
                    @include('som_departments.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
