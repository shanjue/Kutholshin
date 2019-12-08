@extends('layouts.app')

@section('css')
@trixassets
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <h2>Edit Post</h2>
        <form method="post">
            @csrf
            <input type="text" name="title" placeholder="Post Title" value="{{$post->title}}">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

            @trix($post, 'content')
            @trix($post, 'second-content')
            <button class="btn btn-success">Update</button>
            <a class="btn btn-warning" href="{{route('post.create')}}">Back</a>
        </form>
    </div>
</div>
@endsection