@extends('layouts.app')

@section('content')

{{ html()->modelForm($post, 'PUT', '/update-url')->open() }}

{{ html()->div()->class(['form-group','row'])->open() }}
{{ html()->label('Post Title','title') }}
{{ html()->div()->close() }}

{{ html()->text('title')->class(['form-control']) }}
<br>
{{ html()->label('Post Content','content') }}
{{ html()->textarea('content')->class(['form-control'])}}
<br>
{{ html()->label('Start Date','start_date') }}
{{ html()->date('start_date')->class('form-control')}}
<br>
{{ html()->label('End Date','end_date') }}
{{ html()->date('end_date')->class(['form-control'])}}
<br>
{{ html()->label('End Time','end_time') }}
{{ html()->time('end_time')->class(['form-control'])}}
<br>
{{ html()->label('End Time','end_time') }}
{{ html()->time('end_time')->class(['form-control'])}}

{{ html()->closeModelForm() }}

@endsection