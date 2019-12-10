@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Create News</div>

            <div class="card-body">
                <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="exampleFormControlFile1">Example file input</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control-file" name="file[]" id="exampleFormControlFile1" multiple>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('News Title') }}</label>

                        <div class="col-md-6">
                            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ old('title') }}" required autocomplete="title" autofocus>
                        </div>
                    </div>



                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Create News
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection