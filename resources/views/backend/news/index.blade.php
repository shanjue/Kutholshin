@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">News Table With Media Library Testing</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <a href="{{route('news.create')}}" class="btn btn-success">Create News</a>
                    <table class="table table-striped table-border">
                        <thead>
                            <tr>
                                <td>Title</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $new)
                            <tr>
                                <td>
                                    <a href="{{route('news.show',$new->id)}}">
                                        {{$new->title}}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<br />

@endsection