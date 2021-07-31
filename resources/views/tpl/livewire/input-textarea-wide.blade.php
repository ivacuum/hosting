<div>
  <label class="font-semibold @error($name) text-red-700 @enderror {{ $required ? 'input-required' : '' }}">{{ $label ?? ViewHelper::modelFieldTrans($entity, $name) }}</label>
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
  <x-invalid-feedback field="{{ $camelName }}"/>
  @if ($help)
    <div class="form-help">{{ $help }}</div>
  @endif
</div>
