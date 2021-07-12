@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-right">
                    <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                    <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somCountryInfos')}}">Country Info</a>
                    <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="javascript:void(0)">View Som Country Info</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fa fa-info"></i> View Som Country Info</h5>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                           href="{{url('somCountryInfos')}}">
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
                    @include('som_country_infos.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
