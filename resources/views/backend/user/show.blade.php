@extends('layouts.app')

@section('content')
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Export
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{route('savepdf.view',$user->id)}}">Pdf</a>
        <a class="dropdown-item" href="{{route('saveimage.view',$user->id)}}">Image</a>
    </div>
</div>
<img src="/images/simple.jpg" width="500px" height="500px">
<h1>User Show</h1>
<h2>{{$user->name}}</h2>
<h3>{{$user->email}}</h3>
@endsection