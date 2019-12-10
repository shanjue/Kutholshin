@extends('layouts.app')

@section('css')
<style>
    /* This CSS includes a few ways of styling PDF files */

    p:not(.cssonly) a[href$=".pdf"]:before {
        /* PDF file */
        width: 32px;
        height: 32px;
        background: url('http://wwwimages.adobe.com/content/dam/acom/en/legal/images/badges/Adobe_PDF_file_icon_32x32.png');
        display: inline-block;
        content: ' ';
    }

    /* Add " (PDF)" text after links that go to PDFs */
    a[href$=".pdf"]:after {
        content: " (PDF)";
    }

    /* If file size specified as data attribute, use that too */
    a[href$=".pdf"][data-size]:after {
        content: " (PDF, "attr(data-size) ")";
    }

    html {
        font-size: 1em;
        line-height: 1.75;
        font-weight: 200;
        -webkit-font-smoothing: antialiased;
        color: #585451;
        font-family: sans-serif;
    }

    /* p {  background-color: gray; } */

    .cssonly a[href$=".pdf"]:after {
        /* PDF file */
        width: 16px;
        vertical-align: middle;
        margin: 4px 0 2px 4px;
        padding: 4px 0 1px 0px;
        background-color: #fff;
        color: red;
        border: 1px solid red;
        border-top-right-radius: 7px;
        box-shadow: 1px 1px #ccc;
        font-size: 7.7px;
        font-weight: 700;
        font-family: sans-serif;
        line-height: 16px;
        text-decoration: none;
        display: inline-block;
        box-sizing: content-box;
        content: 'PDF';
    }

    .cssonly a[href$=".doc"]:after,
    .cssonly a[href$=".docx"]:after {
        width: 16px;
        vertical-align: middle;
        margin: 4px 0 2px 4px;
        padding: 4px 0 1px 0px;
        background-color: #fff;
        color: #00d;
        border: 1px solid #00d;
        border-top-right-radius: 7px;
        box-shadow: 1px 1px #ccc;
        font-size: 7.7px;
        font-weight: 700;
        font-family: sans-serif;
        line-height: 16px;
        text-decoration: none;
        display: inline-block;
        box-sizing: content-box;
        content: 'DOC';
    }

    .cssonly a[href$=".xls"]:after,
    .cssonly a[href$=".xlsx"]:after {
        width: 16px;
        vertical-align: middle;
        margin: 4px 0 2px 4px;
        padding: 4px 0 1px 0px;
        background-color: #fff;
        color: #090;
        border: 1px solid #090;
        border-top-right-radius: 7px;
        box-shadow: 1px 1px #ccc;
        font-size: 8px;
        font-weight: 700;
        font-family: tahoma, arial, sans-serif;
        letter-spacing: 0.001em;
        line-height: 16px;
        text-decoration: none;
        display: inline-block;
        box-sizing: content-box;
        content: 'XLS';
    }
</style>
@endsection
@section('content')

<div class="dropdown">
    <a href="{{route('news.create')}}" class="btn btn-success">Create News</a>
    <h2>
        News Title - {{$new->title}}
    </h2>
    @foreach($mediaItems as $mediaItem)
    <!-- if image -->
    @if($mediaItem->mime_type == 'image/jpeg')
    <img src='{{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}}' srcset='{{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}} 2400w, {{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}} 1200w, {{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}} 600w' sizes="(min-width: 1200px) 50vw,
            100vw">
    @endif
    <!-- if pdf -->
    @if($mediaItem->mime_type == 'application/pdf')
    <p>Watch out for the
        <a href='{{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}}' data-size="{{round($mediaItem->size/1024)}}KB">
            PDF bomb
        </a> here!
    </p>
    <!-- <embed src='{{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}}' type="application/pdf" width="100%" height="600px" /> -->
    @endif
    <!-- if docx -->
    @if($mediaItem->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
    <p class="cssonly">Content text <a href='{{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}}'>
            DOCX link</a> content text continues. <sup>3</sup>
    </p>
    <!-- <embed src='{{Storage::disk("$mediaItem->disk")->url("$mediaItem->id/$mediaItem->file_name")}}' type="application/pdf" width="100%" height="600px" /> -->
    @endif

    @endforeach
</div>
@endsection