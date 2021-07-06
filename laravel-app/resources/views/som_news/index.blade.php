@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1><i class="far fa-newspaper ml-2"></i> News</h1>
                <a class="btn btn-primary ml-3"
                    href="{{ route('somNews.create') }}">
                    <i class="fa fa-plus"></i> Add Data
                </a>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
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

