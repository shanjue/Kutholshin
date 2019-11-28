@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!
                </div>
                <div class="card-body">
                    
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
        conn.send(JSON.stringify({ command: "subscribe", channel: 'channel_one' }));
    };

    conn.onmessage = function(e) {
        console.log(e.data);
    };
</script>
@endsection