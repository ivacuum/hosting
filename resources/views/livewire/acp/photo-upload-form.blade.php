<?php /** @var \App\Livewire\Acp\PhotoUploadForm $this */ ?>

<div class="grid grid-cols-1 gap-6 md:gap-4">
  <div>Для загрузки фотографий необходимо выбрать поездку или концерт.</div>

  <?php $form = LivewireForm::model(new App\Photo); ?>

  {{ $form->select('tripId')->live()->values($this->tripIds) }}
  {{ $form->select('gigId')->live()->values($this->gigIds) }}
  {{ $form->radio('shouldOverwriteImage')
        ->label('Перезаписать изображение, если такое уже есть на сервере')
        ->values([
          0 => 'Нет',
          1 => 'Да',
        ])
  }}

  @include('tpl.form_errors')

  @if ($this->gigId || $this->tripId)
    <div class="md:grid md:grid-cols-[minmax(min-content,15rem)_1fr] md:gap-4">
      <label class="font-semibold md:leading-6 md:pt-1 @error('file') text-red-700 @enderror">
        @lang('Фотографии')
      </label>
      <div class="max-md:mt-1.5">
        @if ($this->uploaded === $this->total)
          <input
            class="block text-gray-500 w-full file:px-4 file:py-1 file:rounded-sm file:border-0 file:bg-sky-700 file:text-white hover:file:bg-sky-800"
            accept="image/jpeg,image/png"
            type="file"
            multiple
            wire:change="$dispatch('upload-files', $event.currentTarget.files)"
          >
        @else
          @lang('Идет загрузка...') {{ $this->uploaded }} из {{ $this->total }}
        @endif
      </div>
    </div>
  @endif

  @if (count($this->thumbnails))
    <div class="my-4">
      <h3 class="font-medium text-2xl mb-2">История загрузки</h3>
      @foreach ($this->thumbnails as $thumbnail)
        <div>{{ $thumbnail }} ... ok</div>
      @endforeach
    </div>
  @endif

  <script>
  document.addEventListener('livewire:init', function () {
    window.Livewire.on('upload-files', function (files) {
      @this.total += files.length

      for (let i = 0, length = files.length; i < length; i++) {
        @this.upload('file', files[i])
      }
    })
  })
  </script>
</div>
