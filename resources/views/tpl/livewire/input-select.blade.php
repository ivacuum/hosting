<select
  {{ $required ? 'required' : '' }}
  class="form-input {{ implode(' ', $classes) }}"
  wire:model="{{ $camelName }}"
  id="{{ $entity }}_{{ $name }}"
>
  <option value=""></option>
  @foreach ($values as $_value => $_title)
    <option value="{{ $_value }}">{{ $_title }}</option>
  @endforeach
</select>
