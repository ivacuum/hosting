<div>
  <label class="font-semibold @error($name) text-red-700 @enderror {{ $required ? 'input-required' : '' }}">{{ $label }}</label>
  <div class="mt-1">
    @include("acp.tpl.livewire.input-{$type}")
    <x-invalid-feedback field="{{ $name }}"/>
    @if ($help)
      <div class="form-help">{{ $help }}</div>
    @endif
  </div>
</div>
