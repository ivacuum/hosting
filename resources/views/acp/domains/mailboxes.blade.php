@extends("$tpl.base")

@section('content')
<h3>Новая электропочта</h3>
<form action="{{ path("$self@addMailbox", $model) }}" class="mw-600" method="post">
  @csrf

  <div class="form-group">
    <label>Ящик</label>
    <div class="input-group">
      <input class="form-control {{ $errors->has('logins') ? 'is-invalid' : '' }}" name="logins">
      <div class="input-group-append">
        <span class="input-group-text">{{ '@'.$model->domain }}</span>
      </div>
    </div>
    @if ($errors->has('logins'))
      <div class="invalid-feedback d-block">{{ $errors->first('logins') }}</div>
    @endif
    <div class="form-help">Можно указать несколько ящиков через запятую. Пароли будут назначены автоматически</div>
  </div>

  <div class="form-group">
    <label>Выслать инфу по адресу</label>
    <input class="form-control {{ $errors->has('send_to') ? 'is-invalid' : '' }}" type="email" name="send_to" value="{{ Auth::user()->email }}">
    <div class="invalid-feedback">{{ $errors->first('send_to') }}</div>
  </div>

  <button class="btn btn-primary">
    Создать ящик
  </button>
</form>

@if ($mailboxes->total > 0)
  <h3 class="tw-mt-12">Существующие ящики <small class="text-muted">{{ $mailboxes->total }}</small></h3>
  <ul>
    @foreach ($mailboxes->accounts as $account)
      <li>
        @if ($account->enabled == 'no')
          <span class="text-danger"><s>{{ $account->login }}</s></span>
        @elseif ($account->ready == 'yes')
          <span class="text-success">{{ $account->login }}</span>
        @else
          <span class="text-warning">{{ $account->login }}</span>
        @endif
        @if ($account->fio)
          &mdash;
          <span class="text-muted">{{ $account->fio }}</span>
        @endif
        @if (sizeof($account->aliases))
          <div>Алиасы:</div>
          <ul>
            @foreach ($account->aliases as $alias)
              <li>{{ $alias }}</li>
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
  </ul>
  <div>
    <span class="mr-3">
      <span class="badge badge-success px-2 mr-1">&nbsp;</span>
      активен
    </span>
    <span class="mr-3">
      <span class="badge badge-warning px-2 mr-1">&nbsp;</span>
      неактивен
    </span>
    <span class="badge badge-danger px-2 mr-1">&nbsp;</span>
    отключен
  </div>
@endif
@endsection
