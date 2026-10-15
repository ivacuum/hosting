<input
  {{ $required ? 'required' : '' }}
  type="{{ $type }}"
  class="the-input {{ implode(' ', $classes) }}"
  name="{{ $name }}"
  value="{{ ViewHelper::oldString($name, $model->{$name} ?? $default) }}"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
>
