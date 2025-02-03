<select
  {{ $required ? 'required' : '' }}
  class="the-input {{ implode(' ', $classes) }}"
  @if($live)
    wire:model.live="{{ $name }}"
  @elseif($blur)
    wire:model.blur="{{ $name }}"
  @else
    wire:model="{{ $name }}"
  @endif
  id="{{ $entity }}_{{ $name }}"
>
  <option value=""></option>
  @foreach ($values as $_value => $_title)
    <option value="{{ $_value }}">{{ $_title }}</option>
  @endforeach
</select>
