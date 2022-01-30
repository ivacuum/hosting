<div class="grid grid-cols-1 gap-4">
  @include('tpl.form_errors')
  <div>
    <label class="font-semibold @error('file') text-red-700 @enderror">
      @lang('Фотографии')
    </label>
    <div class="mt-1">
      @if ($uploaded === $total)
        <input
          class="block text-muted w-full file:px-4 file:py-1 file:rounded file:border-0 file:bg-blueish-700 file:text-white hover:file:bg-blueish-800"
          accept="image/jpeg,image/png"
          type="file"
          multiple
          wire:change="$emit('upload-files', $event.currentTarget.files)"
        >
      @else
        @lang('Идет загрузка...') {{ $uploaded }} из {{ $total }}
      @endif
    </div>
  </div>

  @if (sizeof($thumbnails))
    <div class="my-4">
      <h3>История загрузки</h3>
      @foreach ($thumbnails as $thumbnail)
        <div>{{ $thumbnail }} ... ok</div>
      @endforeach
    </div>
  @endif

  <script>
  document.addEventListener('livewire:load', function () {
    window.livewire.on('upload-files', function (files) {
      @this.total += files.length

      for (let i = 0, length = files.length; i < length; i++) {
        @this.upload('file', files[i])
      }
    })
  })
  </script>
</div>
