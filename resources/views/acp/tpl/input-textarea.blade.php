@php($value = old($name, $model->{$name}))
<textarea
  {{ $required ? 'required' : '' }}
  class="the-input {{ implode(' ', $classes) }}"
  name="{{ $name }}"
  rows="4"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
>{{ is_array($value) ? '' : $value }}</textarea>
