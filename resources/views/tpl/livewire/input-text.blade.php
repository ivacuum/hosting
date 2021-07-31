<input
  {{ $required ? 'required' : '' }}
  type="{{ $type }}"
  class="form-input {{ implode(' ', $classes) }}"
  @if ($lazy)
    wire:model.lazy="{{ $camelName }}"
  @else
    wire:model="{{ $camelName }}"
  @endif
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
>
