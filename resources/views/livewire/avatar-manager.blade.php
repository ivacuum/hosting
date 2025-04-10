<?php /** @var \App\Livewire\AvatarManager $this */ ?>

<div>
  @if ($this->avatar)
    <div class="flex gap-6 items-center mb-4">
      <img class="w-24 h-24 rounded-full" src="{{ $this->avatar }}" alt="">
      <div>
        <button
          class="btn btn-default"
          wire:click="deleteAvatar"
        >@lang('Удалить аватар')</button>
      </div>
    </div>
  @else
    <div class="mb-4">
      @include('tpl.svg-avatar', [
        'bg' => ViewHelper::avatarBg(Auth::user()->id),
        'text' => Auth::user()->avatarName(),
        'classes' => 'w-24 h-24',
      ])
    </div>
  @endif
  @include('tpl.form_errors')
  <div wire:loading.remove.delay wire:target="image">
    <input
      class="block text-gray-500 w-full file:px-4 file:py-1 file:rounded-sm file:border-0 file:bg-sky-700 file:text-white hover:file:bg-sky-800"
      accept="image/jpeg,image/png"
      type="file"
      id="{{ $this->randomId }}"
      wire:model.live="image"
    >
    <div class="form-help">@lang('Аватар сохраняется автоматически после выбора файла')</div>
  </div>
  <div wire:loading.delay wire:target="image">
    @lang('Идет загрузка...')
  </div>
</div>
