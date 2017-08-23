@if (Auth::check())
  <div class="comment-container no-border">
    <div class="comment-content">
      <aside class="comment-author-container">
        <div class="comment-author">
          <div class="comment-author-avatar">
            @if (Auth::user()->avatar)
              <img class="comment-author-avatar-image" src="{{ Auth::user()->avatarUrl() }}">
            @else
              @include('tpl.svg-avatar', [
                'bg' => ViewHelper::avatarBg(Auth::user()->id),
                'text' => Auth::user()->avatarName(),
              ])
            @endif
          </div>
          <div class="comment-author-details">
            <span class="comment-author-name">{{ Auth::user()->publicName() }}</span>
          </div>
        </div>
      </aside>
      <div class="comment-body-container">
        <div class="comment-body">
          <form action="{{ path('AjaxComment@store', $params) }}" method="post">
            {{ ViewHelper::inputHiddenMail() }}
            <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
              <textarea required class="form-control textarea-autosized js-autosize-textarea" name="text" placeholder="{{ trans('comments.placeholder') }}" rows="1" maxlength="1000">{{ old('text') }}</textarea>
              @if ($errors->has('text'))
                <span class="help-block">{{ $errors->first('text') }}</span>
              @endif
            </div>
            <button class="btn btn-primary">
              {{ trans('comments.send') }}
            </button>
            {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>
@else
  @ru
    <div class="mt-3">
      <p>Для написания комментариев необходимо <a class="link" href="{{ path('Auth@login', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">войти на сайт</a>.</p>
      <p>Можно войти в один клик через следующие соцсети:</p>
      <a class="btn btn-social bg-vk tooltipped tooltipped-n"
         href="{{ path('Auth\Vk@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}"
         aria-label="{{ trans('auth.signin_vk') }}">
        @svg (vk)
      </a>
      <a class="btn btn-social bg-fb tooltipped tooltipped-n"
         href="{{ path('Auth\Facebook@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}"
         aria-label="{{ trans('auth.signin_facebook') }}">
        @svg (facebook)
      </a>
      <a class="btn btn-social bg-google tooltipped tooltipped-n"
         href="{{ path('Auth\Google@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}"
         aria-label="{{ trans('auth.signin_google') }}">
        @svg (google)
      </a>
    </div>
  @en
    <div class="mt-3">
      Please <a class="link" href="{{ path('Auth@login', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">sign in</a> to comment.
    </div>
  @endlang
@endif
