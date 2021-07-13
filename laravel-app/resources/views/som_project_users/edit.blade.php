@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fa fa-user"></i> Edit Som Project Users</h5>
                    <a class="btn btn-default"
                       href="{{ route('somProjectUsers.index') }}" style="color:blue;">
                       <i class="fa fa-chevron-left"></i> Back To List Data Project Users
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="col-sm-12 text-right">
                        <i class="fa fa-tachometer-alt"></i> <a href="{{url('admin')}}">Home</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somProjects')}}">Project</a>
                        <i class="fa fa-angle-right" style="color: blue;"></i>  <a href="{{url('somProjectUsers')}}">Som Project Users</a>
                        <i class="fa fa-angle-right" style="color: black;"></i> Edit Som Project Users
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($somProjectUsers, ['route' => ['somProjectUsers.update', $somProjectUsers->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('som_project_users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('somProjectUsers.index') }}" class="btn btn-default">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
