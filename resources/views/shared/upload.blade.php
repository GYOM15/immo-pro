@php 
$class ??= null;
// Cette variable sera vraie si on veut envoyer plusieurs fichiers
$multiple ??= false;
@endphp

<div @class(['form-group', $class])>
    <label for="{{$name}}">{{$label}} </label>
    <input @if ($multiple) multiple @endif class="form-control  @error($name) is-invalid @enderror" type="file" id="{{$name}}" 
    name="{{$name . ($multiple ? '[]' : '')}}">   
<!-- Here Above the condition that i put in name attribute is to change the name in array if we got multiple files-->
    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>