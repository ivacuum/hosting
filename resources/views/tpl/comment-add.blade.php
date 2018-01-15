@if (Auth::check())
  <div class="d-flex pt-3 w-100">
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
    <div class="text-break-word mw-700 w-100">
      <form action="{{ path('AjaxComment@store', $params) }}" method="post" novalidate>
        {{ ViewHelper::inputHiddenMail() }}
        <textarea required class="form-control textarea-autosized js-autosize-textarea {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text" placeholder="{{ trans('comments.placeholder') }}" rows="1" maxlength="1000">{{ old('text') }}</textarea>
        <div class="invalid-feedback">{{ $errors->first('text') }}</div>
        <button class="btn btn-primary mt-2">
          {{ trans('comments.send') }}
        </button>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
@else
  @ru
    <div class="mt-3">
      <p>Для написания комментариев необходимо <a class="link" href="{{ path('Auth\SignIn@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">войти на сайт</a>.</p>
      <div class="mb-1">Можно войти в один клик через следующие соцсети:</div>
      <a class="btn bg-vk text-white"
         rel="nofollow"
         href="{{ path('Auth\Vk@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">
        {{ trans('auth.vk') }}
      </a>
      <a class="btn bg-facebook text-white"
         rel="nofollow"
         href="{{ path('Auth\Facebook@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">
        {{ trans('auth.facebook') }}
      </a>
      <a class="btn bg-google text-white"
         rel="nofollow"
         href="{{ path('Auth\Google@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">
        {{ trans('auth.google') }}
      </a>
    </div>
  @en
    <div class="mt-3">
      Please <a class="link" href="{{ path('Auth\SignIn@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">sign in</a> to comment.
    </div>
  @endru
@endif
