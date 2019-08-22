<div class="tw-flex tw-pt-4 w-100" id="comment-add">
  @if (Auth::check())
    <aside class="tw-mr-4 md:tw-mr-6">
      <div class="comment-avatar-size tw-mt-1">
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
      <div class="tw-mb-4">
        @ru
          <div>Для комментирования необходимо ввести электронную почту или войти в один клик через один из социальных сервисов ниже.</div>
        @en
          <div>Please type your email or use one-click sign-in through one of the social services below to comment.</div>
        @endru
        <div class="tw-flex tw-mt-2">
          <div class="tw-mr-2 tw-text-center">
            <a
              class="btn bg-vk f20 rounded-circle tw-text-white hover:tw-text-white"
              href="{{ path('Auth\Vk@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (vk)
            </a>
            <div class="tw-mt-1 small text-muted">{{ trans('auth.vk') }}</div>
          </div>
          <div class="tw-mr-2 tw-text-center">
            <a
              class="btn bg-facebook f20 rounded-circle tw-text-white hover:tw-text-white"
              href="{{ path('Auth\Facebook@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (facebook)
            </a>
            <div class="tw-mt-1 small text-muted">{{ trans('auth.facebook') }}</div>
          </div>
          <div class="tw-mr-2 tw-text-center">
            <a
              class="btn bg-google f20 rounded-circle tw-text-white hover:tw-text-white"
              href="{{ path('Auth\Google@index', ['goto' => "{$locale_uri}/{$request_uri}#comment-add"]) }}"
            >
              @svg (google)
            </a>
            <div class="tw-mt-1 small text-muted">{{ trans('auth.google') }}</div>
          </div>
        </div>
      </div>
    @endif
    <form action="{{ path('AjaxComment@store', $params) }}" method="post">
      {{ ViewHelper::inputHiddenMail() }}
      @csrf

      @if (!Auth::check())
        <div class="tw-mb-2">
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
      <button class="btn btn-primary tw-mt-2">
        {{ trans('comments.send') }}
      </button>
    </form>
  </div>
</div>
