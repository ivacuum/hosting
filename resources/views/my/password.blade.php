@extends('my.base')

@section('content')
<h3 class="mt-2 mb-3">{{ trans('my.password') }}</h3>

<form action="{{ action("$self@passwordPut") }}" class="form-horizontal" method="post">
  {{ ViewHelper::inputHiddenMail() }}

  @if ($has_password)
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <div class="col-md-6">
        <label>{{ trans('my.old_password') }}</label>
        <input required type="password" class="form-control" name="password">
        @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
        @endif
      </div>
    </div>
  @endif

  <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
    <div class="col-md-6">
      <label>{{ trans('my.new_password') }}</label>
      <input required type="password" class="form-control" name="new_password">
      @if ($errors->has('new_password'))
        <span class="help-block">{{ $errors->first('new_password') }}</span>
      @else
        @ru
          <span class="help-block">Не менее 6 символов</span>
        @en
          <span class="help-block">Minimum length is 6 characters</span>
        @endlang
      @endif
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary">
        {{ trans("$tpl.save") }}
      </button>
    </div>
  </div>

  {{ method_field('put') }}
  {{ csrf_field() }}
</form>
@endsection
