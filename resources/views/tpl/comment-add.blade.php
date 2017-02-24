@if (Auth::check())
  <div class="row mt-3">
    <div class="col-sm-8">
      <form action="{{ action('Ajax@comment', $params) }}" method="post">
        {{ ViewHelper::inputHiddenMail() }}
        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
          <textarea required class="form-control textarea-autosized js-autosize-textarea" name="text" placeholder="{{ trans('comments.placeholder') }}" rows="1" maxlength="1000">{{ old('text') }}</textarea>
          @if ($errors->has('text'))
            <span class="help-block">{{ $errors->first('text') }}</span>
          @endif
        </div>
        <div class="pull-right">
          <button class="btn btn-primary">
            {{ trans('comments.send') }}
          </button>
        </div>
        {{ csrf_field() }}
        <div class="clearfix"></div>
      </form>
    </div>
  </div>
@else
  @ru
    <div class="mt-3">
      <p>Для написания комментариев необходимо <a class="link" href="{{ action('Auth@login', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">войти на сайт</a>.</p>
      <p>Можно войти в один клик через следующие соцсети:</p>
      <a class="btn btn-social bg-vk tooltipped tooltipped-n"
         href="{{ action('Auth\Vk@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}"
         aria-label="{{ trans('auth.signin_vk') }}">
        @svg (vk)
      </a>
      <a class="btn btn-social bg-facebook tooltipped tooltipped-n"
         href="{{ action('Auth\Facebook@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}"
         aria-label="{{ trans('auth.signin_facebook') }}">
        @svg (facebook)
      </a>
      <a class="btn btn-social bg-google tooltipped tooltipped-n"
         href="{{ action('Auth\Google@index', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}"
         aria-label="{{ trans('auth.signin_google') }}">
        @svg (google)
      </a>
    </div>
  @en
    <div class="mt-3">
      Please <a class="link" href="{{ action('Auth@login', ['goto' => "{$locale_uri}/{$request_uri}#comments"]) }}">sign in</a> to comment.
    </div>
  @endlang
@endif
