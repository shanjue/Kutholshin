@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">User Management</div>

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <a href="{{route('user.create')}}" class="btn btn-success">
                            <i class="fa fa-plus-square"></i>
                            Create User
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{route('admin.home')}}" class="btn btn-success">
                            <i class="fa fa-home"></i>
                            Dashboard
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<br />

@endsection

