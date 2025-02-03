<textarea
  {{ $required ? 'required' : '' }}
  class="the-input {{ implode(' ', $classes) }}"
  @if($live)
    wire:model.live="{{ $name }}"
  @elseif($blur)
    wire:model.blur="{{ $name }}"
  @else
    wire:model="{{ $name }}"
  @endif
  rows="4"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
></textarea>
