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
  <div class="mt-3">Для написания комментариев необходимо <a class="link" href="{{ action('Auth@login', ['goto' => "{$locale_uri}/{$request_uri}"]) }}">войти на сайт</a>.</div>
@endif
