@extends('layouts.app')

@section('title','File Vault')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">File Vault</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    You are logged in!
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="userFile">
                        <button>Submit</button>
                    </form>
                </div>
                <div class="card-body">
                    <h4>Your files</h4>
                    <ul class="list-group">
                        @forelse ($s3Files as $file)
                        <li class="list-group-item">
                            <a href="{{ route('filevault.downloadFile', basename($file)) }}">
                                {{ basename($file) }}
                            </a>
                        </li>
                        @empty
                        <li class="list-group-item">You have no files</li>
                        @endforelse
                    </ul>

                    @if (!empty($localFiles))
                    <hr />
                    <h4>Uploading and encrypting...</h4>
                    <ul class="list-group">
                        @foreach ($localFiles as $file)
                        <li class="list-group-item">
                            {{ basename($file) }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var conn = new WebSocket('ws://localhost:2000');

    var message = document.getElementById('message');

    conn.onopen = function(e) {
        console.log("Connection established!");
        conn.send(JSON.stringify({
            command: "subscribe",
            channel: 'channel_one'
        }));
    };

    conn.onmessage = function(e) {
        console.log(e.data);
    };
</script>
@endsection