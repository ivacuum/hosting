@extends("$tpl.base")

@section('content')
<h3>Новая электропочта</h3>
<form action="{{ action("$self@addMailbox", $model) }}" class="form-horizontal" method="post">

  @include('tpl.form_errors')

  <div class="form-group {{ $errors->has('domain') ? 'has-error' : '' }}">
    <label class="col-md-3 control-label">Ящик:</label>
    <div class="col-md-6">
      <div class="input-group">
        <input type="text" class="form-control" name="logins">
        <span class="input-group-addon">{{ '@'.$model->domain }}</span>
      </div>
      <span class="help-block">Можно указать несколько ящиков через запятую. Пароли будут назначены автоматически</span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-3 control-label">Выслать инфу на:</label>
    <div class="col-md-6">
      <input type="email" class="form-control" name="send_to" value="{{ Auth::user()->email }}">
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-9 col-md-offset-3">
      <button type="submit" class="btn btn-primary">
        Создать ящик
      </button>
    </div>
  </div>

  {{ csrf_field() }}
</form>

@if ($mailboxes->total > 0)
  <h3>Найдено ящиков: {{ $mailboxes->total }}</h3>
  <ul>
    @foreach ($mailboxes->accounts as $account)
      <li>
        @if ($account->enabled == 'no')
          <samp class="text-danger"><s>{{ $account->login }}</s></samp>
        @elseif ($account->ready == 'yes')
          <samp class="text-success">{{ $account->login }}</samp>
        @else
          <samp class="text-warning">{{ $account->login }}</samp>
        @endif
        @if ($account->fio)
          &mdash;
          <span class="text-muted">{{ $account->fio }}</span>
        @endif
        @if (sizeof($account->aliases))
          <br>Алиасы:
          <samp>
            <ul>
              @foreach ($account->aliases as $alias)
                <li>{{ $alias }}</li>
              @endforeach
            </ul>
          </samp>
        @endif
      </li>
    @endforeach
  </ul>
  <p>
    <span class="label label-success"> &nbsp; </span> &nbsp; активен &nbsp;
    <span class="label label-warning"> &nbsp; </span> &nbsp; неактивен &nbsp;
    <span class="label label-danger"> &nbsp; </span> &nbsp; отключен
  </p>
@endif
@endsection
