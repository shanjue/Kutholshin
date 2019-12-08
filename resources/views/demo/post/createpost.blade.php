@extends('layouts.app')

@section('css')
@trixassets
@endsection

@section('content')
<table class="table table-bordered">
    <tr>
        <td>Title</td>
        <td>Rich Text</td>
        <td>Edit</td>
    </tr>
    @foreach($posts as $post)
    <tr>
        <td>{{$post->title}}</td>
        <td>
            @foreach($post->trixRichText as $rich)
            {!! htmlspecialchars_decode($rich->content) !!}
            @endforeach
        </td>
        <td><a href="{{route('post.edit',$post->id)}}">Edit</a></td>
    </tr>
    @endforeach
</table>
<div class="row justify-content-center">
    <div class="col-md-12">
        <h2>Create Post</h2>
        <form method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
            <label for="title">Post Title</label>
            <input type="text" id="title" class="form-control" name="title" placeholder="Post Title">
            @trix(\App\Post::class, 'content')
            @trix(\App\Post::class, 'second-content')
            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection