<!-- class must array but optional-->
<!-- to add stack('js') stack('css') in layout.app.blade.php-->
<!-- $name is assigned.$id is same the $name-->
<!-- need css or js cssjs(['type'=>'trix'])-->

<!-- $type (string) file -->
<!-- $design (boolean) line, design -->
<!-- $name (string) -->
<!-- $required (boolean) true, false -->
<!-- $multiple (boolean)  true, false -->
<!-- $class (string []) -->
@if($type == 'file')
@if($design == 'line')
<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="{{$name}}">
        {{ $label }}
        @if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif
    </label>
    <div class="col-md-6">
        <input type="{{$type}}" @if(isset($required)) @if($required==true) required @endif @endif class='form-control-file  
        @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif
        @error("$name") is-invalid @enderror' name="{{$name}}" id="{{$name}}" @if(isset($multiple))@if($multiple==true) multiple @endif @endif>
        @error("$name")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@elseif($design == 'horizontal')
<div class="form-group">
    <label for="{{  $name }}">
        {{ $label }}
        @if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif
    </label>
    <input type="{{ $type }}" class='form-control-file @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif
    @error("$name") is-invalid @enderror' id="{{ $name}}" name="{{$name}}" @if(isset($required)) @if($required==true) required @endif @endif @if(isset($multiple))@if($multiple==true) multiple @endif @endif>
    @if ($errors->has("$name"))
    <span class="invalid-feedback">
        <strong>{{ $errors->first("$name") }}</strong>
    </span>
    @endif
</div>
@endif
@endif


<!-- input type=text -->
@if($type == 'text')
@if($design == 'line')
<div class="form-group row">
    <label for="{{ $name}}" class="col-md-4 col-form-label text-md-right">
        {{ $label }}
        @if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span> @endif @endif
    </label>

    <div class="col-md-6">
        <input id="{{ $name}}" name="{{ $name }}" type="{{ $type }}" class='form-control @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif
        @error("$name") is-invalid @enderror' value="{{ $data ?? old($name) }}" @if(isset($required)) @if($required==true) required @endif @endif autocomplete="{{$name}}" autofocus placeholder="{{ $label }}">
        @error("$name")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@elseif($design == 'horizontal')
<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif
    </label>
    <input type="{{ $type }}" class='form-control  @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif
    @error("$name") is-invalid @enderror' name="{{$name}}" placeholder="{{ $label }}" value="{{ $data ?? old($name) }}" @if(isset($required)) @if($required==true) required @endif @endif>
    @if ($errors->has("$name"))
    <span class="invalid-feedback">
        <strong>{{ $errors->first("$name") }}</strong>
    </span>
    @endif
</div>
@endif
@endif
<!-- end input type=text  -->

<!-- Trix -->
@if($type == 'trix')
@if($design == 'horizontal')
<div class="form-group">
    <label for="{{$name}}">{{ $label }}@if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif</label>
    <input id="{{$name}}" type="hidden" value='{{ $data ?? old("$name")}}' name="{{$name}}">
    <trix-editor input="{{$name}}"></trix-editor>
    @if ($errors->has("$name"))
    <span class="custom-error-style">
        <strong>{{ $errors->first("$name") }}</strong>
    </span>
    @endif
    <span class="custom-error-style {{$name}}" style="display:none;">
        <strong>{{ucfirst($name)}} field is required.</strong>
    </span>
</div>
@elseif($design == 'line')
<div class="form-group row">
    <label for="{{$name}}" class="col-md-4 col-form-label text-md-right">{{ $label }}@if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif</label>
    <div class="col-md-8">
        <input id="{{$name}}" type="hidden" value='{{ $data ?? old("$name")}}' name="{{$name}}">
        <trix-editor input="{{$name}}"></trix-editor>
        @if ($errors->has("$name"))
        <span class="custom-error-style">
            <strong>{{ $errors->first("$name") }}</strong>
        </span>
        @endif
        <span class="custom-error-style {{$name}}" style="display:none;">
            <strong>{{ucfirst($name)}} field is required.</strong>
        </span>
    </div>
</div>
@endif
@endif
<!-- End Trix -->

<!-- Start Calendar -->
@if($type == 'calendar')
@if($design == 'line')
<div class="form-group row">
    <label for="{{$name}}" class="col-md-4 col-form-label text-md-right">{{$label}}@if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif</label>

    <div class="col-md-6">
        <div class="input-group date">
            <input type="text" name="{{$name}}" class='form-control pull-right datepicker @error("$name") is-invalid @enderror @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif' id="datepicker" @if(isset($required)) @if($required==true) required @endif @endif value='{{ $data ?? old("$name")}}' placeholder="{{$label}}">
            @error("$name")
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
@elseif($design == 'horizontal')
<div class="form-group">
    <label for="{{$name}}">{{$label}}@if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif</label>

    <div class="input-group date">
        <input type="text" name="{{$name}}" class='form-control pull-right datepicker @error("$name") is-invalid @enderror @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif' id="datepicker" @if(isset($required)) @if($required==true) required @endif @endif value='{{ $data ?? old("$name")}}' placeholder="{{$label}}">
        @error("$name")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

</div>
@endif
@endif
<!-- End Calendar -->

<!-- Start TextArea -->
@if($type == 'textarea')
@if($design == 'horizontal')
<div class="form-group">
    <label for="{{$name}}">{{$label}}@if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif</label>
    <textarea id="{{$name}}" name="{{$name}}" rows="3" placeholder="{{$label}}" class='form-control @error("$name") is-invalid @enderror @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif' @if(isset($required)) @if($required==true) required @endif @endif>{{ $data ?? old("$name")}}</textarea>
    @error("$name")
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@elseif($design == 'line')
<div class="form-group row">
    <label for="{{$name}}" class="col-md-4 col-form-label text-md-right">{{$label}}@if(isset($required))@if($required == true)<span style="font-size:20px;color:red;">*</span>@endif @endif</label>

    <div class="col-md-6">
        <textarea id="{{$name}}" name="{{$name}}" rows="3" placeholder="{{$label}}" class='form-control @error("$name") is-invalid @enderror @if(isset($class)) @foreach($class as $val) {{$val}} @endforeach @endif' @if(isset($required)) @if($required==true) required @endif @endif>{{ $data ?? old("$name")}}</textarea>
        @error("$name")
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif
@endif
<!-- End TextArea -->