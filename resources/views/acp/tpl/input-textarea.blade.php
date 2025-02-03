<textarea
  {{ $required ? 'required' : '' }}
  class="the-input {{ implode(' ', $classes) }}"
  name="{{ $name }}"
  rows="4"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
>{{ old($name, $model->{$name}) }}</textarea>
