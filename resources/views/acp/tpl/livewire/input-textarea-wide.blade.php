<div>
  <label class="font-semibold @error($name) text-red-700 @enderror {{ $required ? 'input-required' : '' }}">{{ $label ?? ViewHelper::modelFieldTrans($entity, $name) }}</label>
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
  <x-invalid-feedback field="{{ $name }}"/>
  @if ($help)
    <div class="form-help">{{ $help }}</div>
  @endif
</div>
