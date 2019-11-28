@extends('layouts.app')

@section('title','user export')

@section('content')
{!! $dataTable->table() !!}
@endsection

@section('js')
{!! $dataTable->scripts() !!}
@endsection