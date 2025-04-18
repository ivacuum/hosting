<?php /** @var \App\Livewire\CommentAddForm $this */ ?>

<div>
  @if (Session::has('message'))
    <x-alert-info-dismissable>
      {{ Session::get('message') }}
    </x-alert-info-dismissable>
  @endif
  <div class="flex pt-4 w-full" id="comment-add">
    @if (Auth::check())
      <aside class="mr-4 md:mr-6">
        <div class="comment-avatar-size mt-1">
          @if (Auth::user()->avatar)
            <img class="comment-avatar-size rounded-full" src="{{ Auth::user()->avatarUrl() }}" alt="">
          @else
            @include('tpl.svg-avatar', [
              'bg' => ViewHelper::avatarBg(Auth::user()->id),
              'text' => Auth::user()->avatarName(),
            ])
          @endif
        </div>
      </aside>
    @endif
    <div class="break-words max-w-[700px] w-full">
      @if (!Auth::check())
        <div class="mb-4">
          <div>@lang('Для комментирования необходимо ввести электронную почту или войти в один клик через один из социальных сервисов ниже.')</div>
          <div class="flex gap-2 mt-2">
            <div class="text-center">
              <a
                class="bg-vk-600 inline-flex justify-center items-center size-12 text-xl rounded-full text-white hover:bg-vk-700 hover:text-white"
                href="{{ path([App\Http\Controllers\Auth\Vk::class, 'index'], ['goto' => to(request()->path() . "#comment-add")]) }}"
              >
                @svg (vk)
              </a>
              <div class="mt-1 text-xs text-gray-500">@lang('auth.vk')</div>
            </div>
            <div class="text-center">
              <a
                class="bg-google-600 inline-flex justify-center items-center size-12 text-xl rounded-full text-white hover:bg-google-700 hover:text-white"
                href="{{ path([App\Http\Controllers\Auth\Google::class, 'index'], ['goto' => to(request()->path() . "#comment-add")]) }}"
              >
                @svg (google)
              </a>
              <div class="mt-1 text-xs text-gray-500">@lang('auth.google')</div>
            </div>
          </div>
        </div>
      @endif
      <form wire:submit="submit">
        {{ ViewHelper::inputHiddenMail() }}

        @if (!Auth::check())
          <div class="mb-2">
            <input
              required
              class="the-input"
              type="email"
              wire:model="email"
              placeholder="@lang('model.email')"
            >
            <x-invalid-feedback field="email"/>
          </div>
        @endif
        <textarea
          required
          class="the-input field-sizing-content"
          placeholder="@lang('Оставьте комментарий...')"
          rows="4"
          maxlength="1000"
          wire:model="text"
        ></textarea>
        <x-invalid-feedback field="text"/>
        <button class="btn btn-primary mt-2">
          @lang('Отправить')
        </button>
      </form>
    </div>
  </div>
</div>
