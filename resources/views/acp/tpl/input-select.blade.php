<select
  {{ $required ? 'required' : '' }}
  class="the-input {{ implode(' ', $classes) }}"
  name="{{ $name }}"
  id="{{ $entity }}_{{ $name }}"
>
  <option value=""></option>
  @foreach ($values as $_value => $_title)
    <option value="{{ $_value }}" {{ $_value == old($name, $model->{$name} ?? Request::input($name)) ? 'selected' : '' }}>{{ $_title }}</option>
  @endforeach
</select>
