@php($value = old($name, $model->{$name} ?? $default))
<input
  {{ $required ? 'required' : '' }}
  type="{{ $type }}"
  class="the-input {{ implode(' ', $classes) }}"
  name="{{ $name }}"
  value="{{ is_array($value) ? '' : $value }}"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
>
