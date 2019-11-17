@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <form method="post">
            @csrf
            <div class="form-group">
                <select class="form-control js-multiple-select" name="multipleselect[]" multiple="multiple">
                    <option selected="selected" value="myanmarflag">myanmarflag</option>
                    <option value="myanmarflag">myanmarflag</option>
                    <option value="myanmarflag">myanmarflag</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control js-tag-select" name="tagselect[]" multiple="multiple">
                    <option selected="selected" value="select one">select one</option>
                    <option value="select two">select two</option>
                    <option value="select three">select three</option>
                </select>
            </div>
            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // select2 multiple
    $(".js-multiple-select").select2({
        templateResult: formatState
    });

    $(".js-tag-select").select2({
        tags: true
    });

    function formatState(state) {
        console.log(state)
        if (!state.id) {
            return state.text;
        }
        var baseUrl = "/flags";
        var $state = $(
            '<span><img width="20px"  src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    };
</script>
@endsection