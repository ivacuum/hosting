<?php /** @var \App\Http\Livewire\FeedbackForm $this */ ?>

<div>
  @if (Session::has('message'))
    <div class="my-4">
      <x-alert-info-dismissable>
        {{ Session::get('message') }}
      </x-alert-info-dismissable>
    </div>
  @endif
  <form wire:submit.prevent="submit">
    {{ ViewHelper::inputHiddenMail() }}

    @if(!$this->hideName)
      <div class="mb-4">
        <div class="form-label-group">
          <input required class="form-input" type="text" wire:model.lazy="name" placeholder="@lang('Ваше имя')">
          <label>@lang('Ваше имя')</label>
        </div>
        <x-invalid-feedback field="name"/>
      </div>
    @endif

    <div class="mb-4">
      <div class="form-label-group">
        <input required class="form-input" type="email" wire:model.lazy="email" placeholder="@lang('Электронная почта')">
        <label>@lang('Электронная почта')</label>
      </div>
      <x-invalid-feedback field="email"/>
    </div>

    @if(!$this->hideTitle)
      <div class="mb-4">
        <div class="form-label-group">
          <input required class="form-input" type="text" wire:model.lazy="title" placeholder="@lang('Тема')">
          <label>@lang('Тема')</label>
        </div>
        <x-invalid-feedback field="title"/>
      </div>
    @endif

    <div class="mb-4">
      <label class="font-bold">@lang('Текст сообщения')</label>
      <textarea
        required
        class="form-input"
        name="text"
        rows="4"
        maxlength="1000"
        wire:model.lazy="text"
      ></textarea>
      <x-invalid-feedback field="text"/>
    </div>

    <button class="btn btn-primary text-lg px-4 py-2">
      @lang('Отправить сообщение')
    </button>
  </form>
</div>
