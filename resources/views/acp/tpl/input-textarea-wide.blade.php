@php($value = old($name, $model->{$name}))
<div class="mb-4">
  <label class="font-bold {{ $required ? 'input-required' : '' }}">{{ $label ?? ViewHelper::modelFieldTrans($entity, $name) }}</label>
  <textarea
    {{ $required ? 'required' : '' }}
    class="the-input {{ implode(' ', $classes) }}"
    name="{{ $name }}"
    rows="4"
    placeholder="{{ $placeholder }}"
    id="{{ $entity }}_{{ $name }}"
  >{{ is_array($value) ? '' : $value }}</textarea>
  <x-invalid-feedback field="{{ $name }}"/>
  @if ($help)
    <div class="form-help">{{ $help }}</div>
  @endif
</div>
