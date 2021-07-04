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
        @ru
          <div>Для комментирования необходимо ввести электронную почту или войти в один клик через один из социальных сервисов ниже.</div>
        @en
          <div>Please type your email or use one-click sign-in through one of the social services below to comment.</div>
        @endru
        <div class="flex mt-2">
          <div class="mr-2 text-center">
            <a
              class="btn bg-vk-600 text-xl rounded-full text-white hover:bg-vk-700 hover:text-white"
              href="{{ path([App\Http\Controllers\Auth\Vk::class, 'index'], ['goto' => to("{$requestUri}#comment-add")]) }}"
            >
              @svg (vk)
            </a>
            <div class="mt-1 text-xs text-muted">@lang('auth.vk')</div>
          </div>
          <div class="mr-2 text-center">
            <a
              class="btn bg-facebook-600 text-xl rounded-full text-white hover:bg-facebook-700 hover:text-white"
              href="{{ path([App\Http\Controllers\Auth\Facebook::class, 'index'], ['goto' => to("{$requestUri}#comment-add")]) }}"
            >
              @svg (facebook)
            </a>
            <div class="mt-1 text-xs text-muted">@lang('auth.facebook')</div>
          </div>
          <div class="mr-2 text-center">
            <a
              class="btn bg-google-600 text-xl rounded-full text-white hover:bg-google-700 hover:text-white"
              href="{{ path([App\Http\Controllers\Auth\Google::class, 'index'], ['goto' => to("{$requestUri}#comment-add")]) }}"
            >
              @svg (google)
            </a>
            <div class="mt-1 text-xs text-muted">@lang('auth.google')</div>
          </div>
        </div>
      </div>
    @endif
    <form action="{{ to('ajax/comment/{type}/{id}', $params) }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @if (!Auth::check())
        <div class="mb-2">
          <input
            required
            class="form-input"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="@lang('model.email')"
          >
          <x-invalid-feedback field="email"/>
        </div>
      @endif
      <textarea
        required
        class="form-input {{ !$isMobile ? 'resize-none js-autosize-textarea' : '' }}"
        name="text"
        placeholder="@lang('Оставьте комментарий...')"
        rows="{{ !$isMobile ? 1 : 4 }}"
        maxlength="1000"
      >{{ old('text') }}</textarea>
      <x-invalid-feedback field="text"/>
      <button class="btn btn-primary mt-2">
        @lang('Отправить')
      </button>
    </form>
  </div>
</div>
