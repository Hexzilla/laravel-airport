@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Som Departments</h1>
                </div>
                <div class="col-sm-12">
                    <a class="btn btn-primary float-left"
                       href="{{ route('getLoad') }}">
                        Load Users from AD
                    </a>
                    <a class="btn btn-primary ml-2"
                       href="{{ route('somDepartments.create') }}">
                        Add New
                    </a>
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
        </div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <span><i class="fa fa-folder ml-2"></i> Departments List</span>
                    </div>
                    <div class="col-md-9"></div>
                </div>
            </div>
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

