<?php /** @var \App\Livewire\FeedbackForm $this */ ?>

<div>
  @if (Session::has(App\Domain\SessionKey::FlashMessage))
    <div class="my-4">
      <x-alert-info-dismissable>
        {{ Session::get(App\Domain\SessionKey::FlashMessage) }}
      </x-alert-info-dismissable>
    </div>
  @endif
  <form wire:submit="submit">
    <input hidden type="text" wire:model="mail">

    @if(!$this->hideName)
      <div class="mb-4">
        <div class="form-label-group">
          <input required class="the-input" type="text" wire:model="name" placeholder="@lang('Ваше имя')">
          <label>@lang('Ваше имя')</label>
        </div>
        <x-invalid-feedback field="name"/>
      </div>
    @endif

    <div class="mb-4">
      <div class="form-label-group">
        <input required class="the-input" type="email" wire:model="email" placeholder="@lang('Электронная почта')">
        <label>@lang('Электронная почта')</label>
      </div>
      <x-invalid-feedback field="email"/>
    </div>

    @if(!$this->hideTitle)
      <div class="mb-4">
        <div class="form-label-group">
          <input required class="the-input" type="text" wire:model="title" placeholder="@lang('Тема')">
          <label>@lang('Тема')</label>
        </div>
        <x-invalid-feedback field="title"/>
      </div>
    @endif

    <div class="mb-4">
      <label class="font-bold">@lang('Текст сообщения')</label>
      <textarea
        required
        class="the-input field-sizing-content"
        name="text"
        rows="4"
        maxlength="1000"
        wire:model="text"
      ></textarea>
      <x-invalid-feedback field="text"/>
    </div>

    <button class="btn btn-primary text-lg px-4 py-2">
      @lang('Отправить сообщение')
    </button>
  </form>
</div>
