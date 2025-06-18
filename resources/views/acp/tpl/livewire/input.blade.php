<?php
/**
 * @var string $type
 */
$alignTop = match ($type) {
  'datetime-local',
  'select',
  'text',
  'textarea' => 'md:leading-6 md:pt-1.5',
  default => '',
}
?>
<div class="md:grid md:grid-cols-[minmax(min-content,15rem)_1fr] md:gap-4">
  <label class="font-semibold {{ $alignTop }} @error($name) text-red-700 @enderror {{ $required ? 'input-required' : '' }}">{{ $label }}</label>
  <div class="max-md:mt-1.5">
    @include("acp.tpl.livewire.input-{$type}")
    <x-invalid-feedback field="{{ $name }}"/>
    @if ($help)
      <div class="form-help">{{ $help }}</div>
    @endif
  </div>
</div>
