@extends('layouts.app')

@section('content')
{!! $dataTable->table() !!}
@endsection

@section('js')
{!! $dataTable->scripts() !!}
@endsection