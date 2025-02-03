<input
  {{ $required ? 'required' : '' }}
  type="{{ $type }}"
  class="the-input {{ implode(' ', $classes) }}"
  name="{{ $name }}"
  value="{{ old($name, $model->{$name} ?? $default) }}"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
>
