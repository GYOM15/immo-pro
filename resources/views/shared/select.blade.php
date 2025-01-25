@php
   $class ??=null;
   $name ??= '';
   $value ??= '';
   $label ??= ucfirst($name);
@endphp

<div @class(['form-group', $class])>
    <label for="{{$name}} ">{{$label}} </label>
    <select name="{{$name}}[]" id="{{$name}}" multiple >
        @foreach ($options as $k=>$v )
            <option @selected($value->contains($k)) value="{{$k}}">{{$v}}</option>
        @endforeach
    </select>
        <!--Ici il va falloir récupérer les options donc on doit gérer cela dans le PropertyController pour les methodes edit et create-->
    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>