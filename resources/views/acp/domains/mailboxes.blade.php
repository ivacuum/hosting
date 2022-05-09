<?php /** @var \App\Services\YandexPdd\EmailsResponse $mailboxes */ ?>

@extends("$tpl.base")

@section('content')
<h3>Новая электропочта</h3>
<form action="{{ path([App\Http\Controllers\Acp\Domains::class, 'addMailbox'], $model) }}" class="max-w-[600px]" method="post">
  @csrf

  <div class="mb-4">
    <label>Ящик</label>
    <div class="flex items-center w-full">
      <input class="form-input" type="text" name="logins">
      <div class="ml-2">{{ "@{$model->domain}" }}</div>
    </div>
    <x-invalid-feedback field="logins"/>
    <div class="form-help">Можно указать несколько ящиков через запятую. Пароли будут назначены автоматически</div>
  </div>

  <div class="mb-4">
    <label>Выслать инфу по адресу</label>
    <input class="form-input" type="email" name="send_to" value="{{ Auth::user()->email }}">
    <x-invalid-feedback field="send_to"/>
  </div>

  <button class="btn btn-primary">
    Создать ящик
  </button>
</form>

@if ($mailboxes->total > 0)
  <h3 class="mt-12">Существующие ящики <span class="text-base text-muted">{{ $mailboxes->total }}</span></h3>
  <ul>
    @foreach ($mailboxes->accounts as $account)
      <li>
        @if (!$account->enabled)
          <span class="text-red-600"><s>{{ $account->login }}</s></span>
        @elseif ($account->ready)
          <span class="text-green-600">{{ $account->login }}</span>
        @else
          <span class="text-orange-400">{{ $account->login }}</span>
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
    <span class="mr-4">
      <span class="bg-green-600 rounded mr-1 w-5 h-5 inline-block"></span>
      активен
    </span>
    <span class="mr-4">
      <span class="bg-orange-400 rounded mr-1 w-5 h-5 inline-block"></span>
      неактивен
    </span>
    <span class="bg-red-600 rounded mr-1 w-5 h-5 inline-block"></span>
    отключен
  </div>
@endif
@endsection
