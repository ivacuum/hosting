<?php /** @var \App\Http\Livewire\GalleryUploader $this */ ?>

<div>
  @include('tpl.form_errors')
  <div wire:loading.remove.delay wire:target="files">
    <input
      class="block w-full"
      accept="image/gif,image/jpeg,image/png"
      type="file"
      multiple
      max="10"
      wire:model="files"
    >
    <div class="form-help">@lang('Файлы можно выбрать в появившемся окне или перетащить прямо на элемент выбора')</div>
  </div>
  <div wire:loading.delay wire:target="files">
    @lang('Идет загрузка...')
  </div>

  @if ($this->files)
    <div class="my-6">
      @if (count($this->files) > 1)
        <h3>Ссылки на все картинки</h3>
        <div class="lg:w-4/6">
          <div>
            <div>Ссылка:</div>
            <textarea class="form-input select-all" rows="{{ count($this->files) }}">{{ $this->linksWithoutTags() }}</textarea>
            <div class="mt-2">Полная картинка:</div>
            <input class="form-input select-all" type="text" value="{{ $this->linksWithTags() }}">
          </div>
        </div>
        <h3 class="mt-12">Индивидуальные ссылки</h3>
      @endif
      <div class="grid lg:grid-cols-6 gap-8 mt-4">
        @foreach ($this->links as $link)
          <div class="text-center">
            <img class="inline-block screenshot" src="{{ $link['thumbnail'] }}" alt="">
          </div>
          <div class="lg:col-span-3">
            <div>Ссылка:</div>
            <input class="form-input select-all" type="text" value="{{ $link['original'] }}">
            <div class="mt-2">Полная картинка:</div>
            <input class="form-input select-all" type="text" value="[img]{{ $link['thumbnail'] }}[/img]">
          </div>
          <div class="lg:col-span-2"></div>
        @endforeach
      </div>
    </div>
  @endif
</div>
