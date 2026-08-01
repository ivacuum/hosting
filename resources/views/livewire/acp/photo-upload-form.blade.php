<?php /** @var \App\Livewire\Acp\PhotoUploadForm $this */ ?>

<div class="grid grid-cols-1 gap-6 md:gap-4">
  <div>@lang('Для загрузки фотографий необходимо выбрать поездку или концерт.')</div>

  <?php $form = LivewireForm::model(new \App\Domain\Life\Models\Photo); ?>

  {{ $form->select('tripId')->live()->values($this->tripIds) }}
  {{ $form->select('gigId')->live()->values($this->gigIds) }}
  {{ $form->radio('shouldOverwriteImage')
        ->label(__('Перезаписать изображение, если такое уже есть на сервере'))
        ->values([
          0 => __('Нет'),
          1 => __('Да'),
        ])
  }}

  @include('tpl.form_errors')

  @if ($this->gigId || $this->tripId)
    <div class="md:grid md:grid-cols-(--form-two-columns) md:gap-4">
      <label class="font-semibold md:leading-6 md:pt-1 @error('file') text-red-700 @enderror">
        @lang('Фотографии')
      </label>
      <div class="max-md:mt-1.5">
        @if ($this->processed === $this->total)
          <input
            class="block text-gray-500 w-full file:px-4 file:py-1 file:rounded-sm file:border-0 file:bg-sky-700 file:text-white hover:file:bg-sky-800"
            accept="image/jpeg,image/png"
            type="file"
            multiple
            wire:change="$dispatch('upload-files', $event.currentTarget.files)"
          >
        @else
          @lang('Обработано') {{ $this->processed }} @lang('из') {{ $this->total }}.
          @lang('Успешно загружено:') {{ $this->uploaded }}
        @endif
      </div>
    </div>
  @endif

  @if (count($this->uploadResults))
    <div class="my-4">
      <h3 class="font-medium text-2xl mb-2">@lang('История загрузки')</h3>
      @foreach ($this->uploadResults as $result)
        <div @class([
          'text-gray-500' => $result['status'] === 'pending',
          'text-red-700' => $result['status'] === 'error',
        ])>
          <span class="font-medium">{{ $result['filename'] }}</span>
          ...
          @if ($result['status'] === 'success')
            ok ({{ $result['message'] }})
          @else
            {{ $result['message'] }}
          @endif
        </div>
      @endforeach
    </div>
  @endif

  @script
  <script>
    const uploadCancelledMessage = @js(__('Загрузка отменена.'))

    $wire.$on('upload-files', async function (files) {
      files = Array.from(files)

      await $wire.queueFiles(files.map((file) => file.name))

      for (let i = 0, length = files.length; i < length; i++) {
        const file = files[i]

        $wire.$upload(
          'file',
          file,
          () => {},
          () => $wire.uploadFailed(file.name),
          () => {},
          () => $wire.uploadFailed(file.name, uploadCancelledMessage),
        )
      }
    })
  </script>
  @endscript
</div>
