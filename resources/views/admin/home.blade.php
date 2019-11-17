@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>


                    You are logged in as admin!
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Management</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <a href="{{route('user.index')}}" class="btn btn-primary">All Users</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('user.create')}}" class="btn btn-success">
                                <i class="fa fa-plus-square"></i>
                                Create User
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Center Management</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <a href="{{route('center.index')}}" class="btn btn-primary">All Centers</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{route('center.create')}}" class="btn btn-success">
                                <i class="fa fa-plus-square"></i>
                                Create Center
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection