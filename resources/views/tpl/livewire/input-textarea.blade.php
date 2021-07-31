<textarea
  {{ $required ? 'required' : '' }}
  class="form-input {{ !$isMobile ? 'resize-none js-autosize-textarea' : '' }} {{ implode(' ', $classes) }}"
  @if ($lazy)
    wire:model.lazy="{{ $camelName }}"
  @else
    wire:model="{{ $camelName }}"
  @endif
  rows="{{ !$isMobile ? 2 : 6 }}"
  placeholder="{{ $placeholder }}"
  id="{{ $entity }}_{{ $name }}"
></textarea>
