@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    <i class="far fa-newspaper ml-2"></i> News
                    <a class="btn btn-primary pl-2"
                        href="{{ route('somNews.create') }}">
                        <i class="fas fa-plus-circle mr-2"></i>Add New
                    </a>
                </h1>
            </div>
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="#">
                        <i class="fa fa-palette"></i> Home
                    </a>
                    <a href="#" style="color:black; cursor: text; text-decoration: none;">
                        <i class="fa fa-chevron-right"></i> News
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
    </div>

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <span><i class="far fa-newspaper ml-2"></i> News List</span>
                </div>
                <div class="col-md-9"></div>
            </div>
        </div>
        <div class="card-body p-0">
            @include('som_news.table')

            <div class="card-footer clearfix float-right">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
