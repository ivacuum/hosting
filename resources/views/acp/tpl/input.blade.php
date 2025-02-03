<div class="mb-4">
  <label class="font-bold {{ $required ? 'input-required' : '' }}">{{ $label ?? ViewHelper::modelFieldTrans($entity, $name) }}</label>
  @include("acp.tpl.input-{$type}")
  <x-invalid-feedback field="{{ $name }}"/>
  @if ($help)
    <div class="form-help">{{ $help }}</div>
  @endif
</div>
