@extends('layouts.app')

@section('title','user2 export')

@section('content')
{!! $dataTable->table() !!}
@endsection

@section('js')
{!! $dataTable->scripts() !!}
@endsection