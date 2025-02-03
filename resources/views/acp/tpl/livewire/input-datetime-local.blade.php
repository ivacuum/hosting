<input
  {{ $required ? 'required' : '' }}
  type="{{ $type }}"
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
