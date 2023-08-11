@props([
    'type', 'value', 'name', 'placeholder', 'icon'
])


<input type="{{ $type }}"
       class="form-control @error("$name") is-invalid @enderror"
       name="{{ $name }}" id="{{ $name }}"  value="{{ old($name, $value) }}"
       placeholder="{{$placeholder}}"/>
@if($errors->has($name))
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
@endif
