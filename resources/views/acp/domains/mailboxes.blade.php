@extends("$tpl.base")

@section('content')
<h3>Новая электропочта</h3>
<form action="{{ path("$self@addMailbox", $model) }}" class="tw-max-w-600px" method="post">
  @csrf

  <div class="tw-mb-4">
    <label>Ящик</label>
    <div class="input-group">
      <input class="form-control {{ $errors->has('logins') ? 'is-invalid' : '' }}" name="logins">
      <div class="input-group-append">
        <span class="input-group-text">{{ '@'.$model->domain }}</span>
      </div>
    </div>
    @if ($errors->has('logins'))
      <div class="invalid-feedback tw-block">{{ $errors->first('logins') }}</div>
    @endif
    <div class="form-help">Можно указать несколько ящиков через запятую. Пароли будут назначены автоматически</div>
  </div>

  <div class="tw-mb-4">
    <label>Выслать инфу по адресу</label>
    <input class="form-control {{ $errors->has('send_to') ? 'is-invalid' : '' }}" type="email" name="send_to" value="{{ Auth::user()->email }}">
    <div class="invalid-feedback">{{ $errors->first('send_to') }}</div>
  </div>

  <button class="btn btn-primary">
    Создать ящик
  </button>
</form>

@if ($mailboxes->total > 0)
  <h3 class="tw-mt-12">Существующие ящики <span class="tw-text-base text-muted">{{ $mailboxes->total }}</span></h3>
  <ul>
    @foreach ($mailboxes->accounts as $account)
      <li>
        @if ($account->enabled == 'no')
          <span class="tw-text-red-600"><s>{{ $account->login }}</s></span>
        @elseif ($account->ready == 'yes')
          <span class="tw-text-green-600">{{ $account->login }}</span>
        @else
          <span class="tw-text-orange-400">{{ $account->login }}</span>
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
    <span class="tw-mr-4">
      <span class="tw-bg-green-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded tw-px-2 tw-mr-1">&nbsp;</span>
      активен
    </span>
    <span class="tw-mr-4">
      <span class="tw-bg-orange-400 tw-p-1 tw-text-xs tw-font-bold tw-rounded tw-px-2 tw-mr-1">&nbsp;</span>
      неактивен
    </span>
    <span class="tw-bg-red-600 tw-text-white tw-p-1 tw-text-xs tw-font-bold tw-rounded tw-px-2 tw-mr-1">&nbsp;</span>
    отключен
  </div>
@endif
@endsection
