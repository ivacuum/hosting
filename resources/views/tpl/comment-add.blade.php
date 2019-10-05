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
  <div class="break-words max-w-700px w-full">
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
              class="btn bg-vk text-xl rounded-full text-white hover:text-white"
              href="{{ path('Auth\Vk@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (vk)
            </a>
            <div class="mt-1 text-xs text-muted">{{ trans('auth.vk') }}</div>
          </div>
          <div class="mr-2 text-center">
            <a
              class="btn bg-facebook text-xl rounded-full text-white hover:text-white"
              href="{{ path('Auth\Facebook@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (facebook)
            </a>
            <div class="mt-1 text-xs text-muted">{{ trans('auth.facebook') }}</div>
          </div>
          <div class="mr-2 text-center">
            <a
              class="btn bg-google text-xl rounded-full text-white hover:text-white"
              href="{{ path('Auth\Google@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (google)
            </a>
            <div class="mt-1 text-xs text-muted">{{ trans('auth.google') }}</div>
          </div>
        </div>
      </div>
    @endif
    <form action="{{ path('AjaxComment@store', $params) }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @if (!Auth::check())
        <div class="mb-2">
          <input
            required
            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="{{ trans('model.email') }}"
          >
          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>
      @endif
      <textarea
        required
        class="form-control {{ !$is_mobile ? 'textarea-autosized js-autosize-textarea' : '' }} {{ $errors->has('text') ? 'is-invalid' : '' }}"
        name="text"
        placeholder="{{ trans('comments.placeholder') }}"
        rows="{{ !$is_mobile ? 1 : 4 }}"
        maxlength="1000"
      >{{ old('text') }}</textarea>
      <div class="invalid-feedback">{{ $errors->first('text') }}</div>
      <button class="btn btn-primary mt-2">
        {{ trans('comments.send') }}
      </button>
    </form>
  </div>
</div>
