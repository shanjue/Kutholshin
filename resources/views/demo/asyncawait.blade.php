@extends('layouts.app')

@section('title','Async-Await')

@section('css')
<style>
    span {
        background: red;
    }

    img {
        width: 600px;
        height: 450px;
        background: url(loading.gif) 50% no-repeat;
        border: 1px solid black;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>Async Await</h1>
    <h2>Show Info Wait Promise All Finish - <span id="wait"></span></h2>
    <button onclick="showInfoWaitPromiseAllFinish()" class="btn btn-secondary">Run showInfoWaitPromiseAllFinish()</button>
</div>
<hr>
<div class="container">
    <h2>Show Info No Wait Promise All Finish - <span id="nowait"></span></h2>
    <button onclick="showInfoNoWaitPromiseAllFinish()" class="btn btn-secondary">Run showInfoNoWaitPromiseAllFinish()</button>
</div>
<hr>
<div class="container">
    <h2>Get Data From Promise - <span id="getdata"></span></h2>
    <button onclick="getDataFromPromise()" class="btn btn-secondary">Run getDataFromPromise()</button>
</div>
<hr>
<div class="container">
    <h2>Error Handling - <span id="errorHandling"></span></h2>
    <button onclick="errorHandling()" class="btn btn-secondary">Run errorHandling()</button>
</div>
<hr>
<div class="container">
    <h2>Syntax Error Handling - <span id="syntaxErrorHandling"></span></h2>
    <button onclick="syntaxErrorHandling('abc')" class="btn btn-secondary">Run syntaxErrorHandling('abc')</button>
    <button onclick="syntaxErrorHandling(123)" class="btn btn-secondary">Run syntaxErrorHandling('123')</button>
</div>
<hr>
<div class="container">
    <h2>Fetch User - <span id="fetchUser"></span></h2>
    <button onclick="fetchUser('getUserAsyncAwait')" class="btn btn-secondary">Run fetchUser('getUserAsyncAwait')</button>
</div>
<hr>
<div class="container">
    <h2>Image Async and Await</h2>
    <div id="image-holder"></div>
    <button onclick="asyncImage('http://thecatapi.com/api/images/get?format=src&type=jpg&size=small')" class="btn btn-secondary">Run asyncImage()</button>
</div>
<hr>
<div class="container">
    <h2>Asynchronous Image Loading with JavaScript</h2>
    <img src="clear.gif">

</div>

@endsection

@section('js')
<script>
    function who() {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve('Mg Mg')
            }, 1000);
        });
    }

    function live() {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve(' live in ')
            }, 2000);
        });
    }

    function where() {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve('Yangon')
            }, 3000);
        });
    }
    async function showInfoNoWaitPromiseAllFinish() {
        var span = document.getElementById('nowait');
        const a = await who();
        span.append(a)
        const b = await live();
        span.append(b)
        const c = await where();
        span.append(c)

    }
    async function showInfoWaitPromiseAllFinish() {
        var span = document.getElementById('wait');
        // wait finish all function
        const [a, b, c] = await Promise.all([who(), live(), where()]);
        span.append(a)
        span.append(b)
        span.append(c)
    }

    async function hello() {
        return 'Hello Alligator!';
    }

    function getDataFromPromise() {
        var span = document.getElementById('getdata');
        var a = hello();

        a.then(x => span.append(x))
    }

    function yayOrNay() {
        return new Promise((resolve, reject) => {
            const val = Math.round(Math.random() * 1)
            val ? resolve('No Error') : reject('Has Error');
        });
    }

    async function errorHandling() {
        var span = document.getElementById('errorHandling');
        span.textContent = ' ';

        try {
            var a = await yayOrNay();
            span.append(a)
        } catch (err) {
            span.append(err)
        }

    }

    function caseUpper(val) {
        return new Promise((resolve, reject) => {
            resolve(val.toUpperCase())
        })
    }
    async function syntaxErrorHandling(val) {
        var span = document.getElementById('syntaxErrorHandling');
        span.textContent = ' ';
        try {
            var a = await caseUpper(val)
            span.append(a)
        } catch (err) {
            span.append("Oh No:" + err.message)
        }
    }

    async function fetchUser(endpoint) {
        var span = document.getElementById('fetchUser')
        const res = await fetch(endpoint);

        let data = await res.json();

        data = data.map(user => {
            span.append(user.username + " - ")
            return user.username
        });
    }

    function loadImage(url) {
        return new Promise((resolve, reject) => {
            let img = new Image();
            img.addEventListener('load', e => resolve(img));
            img.addEventListener('error', () => {
                reject(new Error(`Failed to load image's URL: ${url}`));
            });
            img.src = url;
            img.width = 200;
            img.height = 200;
        });
    }

    function asyncImage(url) {
        // load the image, and append it to the element id="image-holder"
        loadImage(url)
            .then(img => document.getElementById('image-holder').appendChild(img))
            .catch(error => console.error(error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Asynchronous Image Loading with JavaScript
        var image = document.images[0];
        var downloadingImage = new Image();
        downloadingImage.onload = function() {
            image.src = this.src;
        };
        downloadingImage.src = "http://thecatapi.com/api/images/get?format=src&type=jpg&size=small";
    });
</script>
@endsection