<div class="row m-t-1">
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
