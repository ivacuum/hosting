<div class="mb-4">
  <label class="font-bold {{ $required ? 'input-required' : '' }}">{{ $label ?? ViewHelper::modelFieldTrans($entity, $name) }}</label>
  <textarea
    {{ $required ? 'required' : '' }}
    class="the-input {{ implode(' ', $classes) }}"
    name="{{ $name }}"
    rows="4"
    placeholder="{{ $placeholder }}"
    id="{{ $entity }}_{{ $name }}"
  >{{ old($name, $model->{$name}) }}</textarea>
  <x-invalid-feedback field="{{ $name }}"/>
  @if ($help)
    <div class="form-help">{{ $help }}</div>
  @endif
</div>
