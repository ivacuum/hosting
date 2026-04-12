<?php
/** @var \App\Domain\Exif\Livewire\ExifReader $this */
?>

<form
  wire:submit="submit"
  x-data="{ progress: 0 }"
  x-on:livewire-upload-progress="progress = $event.detail.progress"
>
  <p>На этой странице можно загрузить изображение в формате JPEG, чтобы посмотреть какие метаданные в него записал производитель камеры или программа, с помощью которой обрабатывали снимок. Если изображение сохранено из социальных сетей, то они скорее всего вырезали все метаданные в угоду уменьшения размера файла.</p>
  <p>Загруженный вами файл будет автоматически удален через пять минут.</p>
  <p>Выберите JPEG-файл:</p>
  @include('tpl.form_errors')
  <div wire:target="image">
    <input
      class="block text-gray-500 w-full file:px-4 file:py-1 file:rounded-sm file:border-0 file:bg-sky-700 file:text-white hover:file:bg-sky-800"
      type="file"
      wire:model.live="image"
    >
  </div>
  <div
    class="mt-4"
    wire:loading.delay
    wire:target="image"
  >
    @lang('Идет загрузка...')
    <progress
      class="[&::-webkit-progress-bar]:bg-gray-300 [&::-webkit-progress-value]:bg-green-600 [&::-moz-progress-bar]:bg-green-600 w-40 h-4"
      max="100"
      x-bind:value="progress"
    ></progress>
    <span x-text="progress"></span>%
  </div>
  @if($this->image && $errors->isEmpty())
    <div class="my-4">
      @if(!$errors->has('image'))
      <button type="submit" class="btn btn-default">
        @lang('Прочитать EXIF-данные')
      </button>
      @endif
    </div>

    <div>
      @if($this->data['Make'] ?? '' && $this->data['Model'])
        Снимок сделан на <span class="font-bold">{{ $this->data['Make'] }} {{ $this->data['Model'] }}</span>.
      @endif
      @if($this->size && $this->width && $this->height)
          Изображение занимает <span class="font-bold">{{ ViewHelper::size($this->size) }}</span> постоянной памяти при размере <span class="font-bold">{{ $this->width }}×{{ $this->height }}</span> точек.
      @endif
      @if($this->date)
        Оно сделано <span class="font-bold">{{ $this->date->isoFormat('LLL') }}</span>.
      @endif
      @if($this->data['UndefinedTag:0x9010'] ?? '')
        Часовой пояс <span class="font-bold">{{ $this->data['UndefinedTag:0x9010'] }}</span>.
      @endif
      @if($this->data['Orientation'] ?? '')
        @switch($this->data['Orientation'])
          @case('3') Кадр сделан вверх ногами. @break
          @case('6') Кадр повернут на 90º по часовой стрелке. @break
          @case('8') Кадр повернут на 90º против часовой стрелки. @break
        @endswitch
      @endif
      @if($this->data['FocalLengthIn35mmFilm'] ?? '')
        Фокусное расстояние <span class="font-bold">{{ $this->data['FocalLengthIn35mmFilm'] }}мм</span>, если сравнивать с камерой.
      @endif
      @if($this->lat && $this->lon)
        <a href="https://www.google.com/maps/search/?api=1&query={{ $this->lat }}%2C{{ $this->lon }}">Место снимка на карте</a>.
      @endif
      @if($this->data['GPSAltitude'] ?? '' && $this->data['GPSAltitudeRef'])
        Фотография сделана на высоте <span class="font-bold lowercase">{{ $this->valueForHumans('GPSAltitude', $this->data['GPSAltitude']) }} {{ $this->valueForHumans('GPSAltitudeRef', $this->data['GPSAltitudeRef']) }}</span>.
      @endif
      @if($this->gpsImageDirection)
        При этом камера смотрела на <span class="font-bold">{{ $this->valueForHumans('GPSImgDirection', $this->data['GPSImgDirection']) }}</span><svg class="svg-icon" viewBox="0 0 1792 1792" width="16" height="16" style="transform: rotate({{ $this->gpsImageDirection - 45 }}deg);"><path d="M103,703.4L1683,125L1104.6,1705L867.9,940.1L103,703.4z"/></svg>, если свериться с компасом <span class="text-gray-500">(0º — север, 90º — восток, 180º — юг, 270º — запад)</span>.
      @endif
      @if(($this->data['GPSSpeed'] ?? '') && !str_starts_with($this->data['GPSSpeed'] ?? '', '0'))
        Скорость движения во время съемки составила <span class="whitespace-nowrap"><span class="font-bold">{{ $this->valueForHumans('GPSSpeed', $this->data['GPSSpeed']) }}</span>
        @if($this->data['GPSSpeedRef'] ?? '')
          @switch($this->data['GPSSpeedRef'])
            @case('K') <span class="font-bold">км/ч</span>. @break
            @case('M') <span class="font-bold">м/ч</span>. @break
            @case('N') <span class="font-bold">узлов</span>. @break
          @endswitch
        @endif
        </span>
      @endif
    </div>

    @if($this->read && $this->data === [])
      <div class="my-4">
        <x-alert-info>
          <div>Метаданные не обнаружены 🤷‍♂️ Попробуйте другой файл.</div>
        </x-alert-info>
      </div>
    @endif

    @foreach($this->data as $key => $value)
      <h3 class="text-xl font-medium mt-6">{{ $key }}</h3>
      <?php $valueForHumans = $this->valueForHumans($key, $value) ?>
      @if(is_array($value))
        <ul>
          @foreach($value as $key2 => $value2)
            <li>{{ $key2 }}: {{ $value2 }}</li>
          @endforeach
        </ul>
        @if($valueForHumans)
          <div class="text-gray-500">({{ $this->valueForHumans($key, $value) }})</div>
        @endif
        @switch($key)
          @case('GPSLatitude')
            <div class="text-gray-500">({{ $this->lat }})</div>
          @break
          @case('GPSLongitude')
            <div class="text-gray-500">({{ $this->lon }})</div>
          @break
        @endswitch
      @else
        <div>
          {{ $value }}
          @if($valueForHumans)
            <span class="text-gray-500">({{ $this->valueForHumans($key, $value) }})</span>
          @endif
        </div>
      @endif
    @endforeach
  @endif
</form>
