<?php /** @var \App\Livewire\Acp\PhotoUploadForm $this */ ?>

<div class="grid grid-cols-1 gap-4">
  <div>Для загрузки фотографий необходимо выбрать поездку или концерт.</div>

  <?php LivewireForm::model(new App\Photo); ?>

  {{ LivewireForm::select('tripId')->values($this->tripIds) }}
  {{ LivewireForm::select('gigId')->values($this->gigIds) }}

  @include('tpl.form_errors')

  @if ($this->gigId || $this->tripId)
    <div>
      <label class="font-semibold @error('file') text-red-700 @enderror">
        @lang('Фотографии')
      </label>
      <div class="mt-1">
        @if ($this->uploaded === $this->total)
          <input
            class="block text-muted w-full file:px-4 file:py-1 file:rounded file:border-0 file:bg-blueish-700 file:text-white hover:file:bg-blueish-800"
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
