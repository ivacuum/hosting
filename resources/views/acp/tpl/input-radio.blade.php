@foreach ($values as $_value => $_title)
  <label class="flex gap-2 items-center">
    <input
      class="not-checked:border-gray-300 text-sky-600"
      type="radio"
      name="{{ $name }}"
      value="{{ $_value }}"
      {{ $_value == old($name, $model->{$name} instanceof BackedEnum ? $model->{$name}->value : $model->{$name}) ? 'checked' : '' }}
    >
    {{ $_title }}
  </label>
@endforeach
