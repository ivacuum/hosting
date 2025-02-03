<?php /** @var \App\Livewire\GalleryUploader $this */ ?>

<div>
  @include('tpl.form_errors')
  <div wire:loading.remove.delay wire:target="files">
    <input
      class="block text-gray-500 w-full file:px-4 file:py-1 file:rounded-sm file:border-0 file:bg-sky-700 file:text-white hover:file:bg-sky-800"
      accept="image/gif,image/jpeg,image/png"
      type="file"
      multiple
      max="10"
      wire:model.live="files"
    >
    <div class="form-help">@lang('Файлы можно выбрать в появившемся окне или перетащить прямо на элемент выбора')</div>
  </div>
  <div wire:loading.delay wire:target="files">
    @lang('Идет загрузка...')
  </div>

  @if ($this->files)
    <div class="my-6">
      @if (count($this->files) > 1)
        <h3 class="font-medium text-2xl mb-2">Ссылки на все картинки</h3>
        <div class="lg:w-4/6">
          <div>
            <div>Ссылка:</div>
            <textarea class="the-input select-all" rows="{{ count($this->files) }}">{{ $this->linksWithoutTags() }}</textarea>
            <div class="mt-2">Полная картинка:</div>
            <input class="the-input select-all" type="text" value="{{ $this->linksWithTags() }}">
          </div>
        </div>
        <h3 class="font-medium text-2xl mb-2 mt-12">Индивидуальные ссылки</h3>
      @endif
      <div class="grid lg:grid-cols-6 gap-8 mt-4">
        @foreach ($this->links as $link)
          <div class="text-center">
            <img class="inline-block screenshot" src="{{ $link['thumbnail'] }}" alt="">
          </div>
          <div class="lg:col-span-3">
            <div>Ссылка:</div>
            <input class="the-input select-all" type="text" value="{{ url($link['original']) }}">
            <div class="mt-2">Полная картинка:</div>
            <input class="the-input select-all" type="text" value="[img]{{ url($link['thumbnail']) }}[/img]">
          </div>
          <div class="lg:col-span-2"></div>
        @endforeach
      </div>
    </div>
  @endif
</div>
