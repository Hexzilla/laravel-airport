@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class='fa fa-globe'></i> Country Info</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-right">                                                
                        <a href="#">
                            <i class="fa fa-palette"></i> Home
                        </a>
                        <a href="#">
                            <i class="fa fa-chevron-right"></i> Country Info
                        </a>                        
                    </div>                        
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="row ml-1">
            <div class="col-md-6 mb-4">
                <a href="{{ route('somCountries.index') }}">
                    <i class="fa fa-chevron-left"></i> Back To List Data Addtional Infomation
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <a class="btn btn-primary float-right"
                    href="{{ route('somCountryInfos.create',['somCountry_id'=> $somCountry_id]) }}">
                        Add New
                </a>
            </div>
        </div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <span><i class="fa fa-bars ml-2"></i> Additional Infomation</span>
                    </div>
                    <div class="col-md-9"></div>
                </div>                
            </div>
            <div class="card-body p-3" >
                <div class="row">
                    <div class="col-md-2">
                        <span>Som Country Id</span>
                    </div>
                    <div class="col-md-10">
                        <span>{!! $somCountry_id !!}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                @include('som_country_infos.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

