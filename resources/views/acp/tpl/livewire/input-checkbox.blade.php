@foreach ($values as $_value => $_title)
  <label class="flex gap-2 items-center">
    <input
      class="not-checked:border-gray-300 text-sky-600"
      type="checkbox"
      @if($live)
        wire:model.live="{{ $name }}"
      @elseif($blur)
        wire:model.blur="{{ $name }}"
      @else
        wire:model="{{ $name }}"
      @endif
      value="{{ $_value }}"
    >
    {{ $_title }}
  </label>
@endforeach
