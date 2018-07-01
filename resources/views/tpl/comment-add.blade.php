<div class="d-flex pt-3 w-100" id="comment-add">
  @if (Auth::check())
    <aside class="mr-3 mr-md-4">
      <div class="comment-avatar-size mt-1">
        @if (Auth::user()->avatar)
          <img class="comment-avatar-size rounded-circle" src="{{ Auth::user()->avatarUrl() }}">
        @else
          @include('tpl.svg-avatar', [
            'bg' => ViewHelper::avatarBg(Auth::user()->id),
            'text' => Auth::user()->avatarName(),
          ])
        @endif
      </div>
    </aside>
  @endif
  <div class="text-break-word mw-700 w-100">
    @if (!Auth::check())
      <div class="mb-3">
        @ru
          <div>Для комментирования необходимо ввести электронную почту или войти в один клик через один из социальных сервисов ниже.</div>
        @en
          <div>Please type your email or use one-click sign-in through one of the social services below to comment.</div>
        @endru
        <div class="d-flex mt-2">
          <div class="mr-2 text-center">
            <a
              class="btn bg-vk f20 rounded-circle text-white"
              href="{{ path('Auth\Vk@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (vk)
            </a>
            <div class="mt-1 small text-muted">{{ trans('auth.vk') }}</div>
          </div>
          <div class="mr-2 text-center">
            <a
              class="btn bg-facebook f20 rounded-circle text-white"
              href="{{ path('Auth\Facebook@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (facebook)
            </a>
            <div class="mt-1 small text-muted">{{ trans('auth.facebook') }}</div>
          </div>
          <div class="mr-2 text-center">
            <a
              class="btn bg-google f20 rounded-circle text-white"
              href="{{ path('Auth\Google@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (google)
            </a>
            <div class="mt-1 small text-muted">{{ trans('auth.google') }}</div>
          </div>
        </div>
      </div>
    @endif
    <form action="{{ path('AjaxComment@store', $params) }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
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
      {{ csrf_field() }}
    </form>
  </div>
</div>
