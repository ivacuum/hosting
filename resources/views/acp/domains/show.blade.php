<?php /** @var \App\Domain $model */ ?>

@extends('acp.show', [
  'metaTitle' => $model->domain,
])

@section('content')
@if (!$model->isExpired() && ($model->cms_url || ($model->alias_id && $model->alias->cms_url)))
  <div class="mb-4">
    @include("$tpl.cms_login", ['cmsButtonClass' => 'btn btn-default'])
  </div>
@endif

@if ($model->text)
  <blockquote class="whitespace-pre-line">{{ $model->text }}</blockquote>
@endif

@if ($model->isExpired())
  <x-alert-danger>
    Подошел срок оплаты домена — {{ $model->paid_till?->addMonth()->isoFormat('D MMMM') }} ({{ $model->paid_till?->addMonth()->diffForHumans() }}) он совсем пропадет
  </x-alert-danger>
@endif

@if ($model->isExpiringSoon())
  <x-alert-warning>
    {{ $model->paid_till->isoFormat('D MMMM') }} ({{ $model->paid_till->diffForHumans() }}) подходит срок оплаты домена
  </x-alert-warning>
@endif

<table class="table-stats">
  @if ($model->alias)
    <tr>
      <td class="text-right font-bold">Алиас</td>
      <td>
        <a href="{{ Acp::show($model->alias) }}">{{ $model->alias->domain }}</a>
      </td>
    </tr>
  @endif
  @if (count($model->aliases))
    <tr>
      <td class="text-right font-bold">Алиасы</td>
      <td>
        @foreach ($model->aliases as $alias)
          <a href="{{ Acp::show($alias) }}">{{ $alias->domain }}</a>
        @endforeach
      </td>
    </tr>
  @endif
  <tr>
    <td class="text-right font-bold">Клиент</td>
    <td>
      <a href="{{ Acp::show($model->client) }}">
        {{ $model->client->name }}
      </a>
    </td>
  </tr>
  @if ($model->yandex_user_id)
    <tr>
      <td class="text-right font-bold">Яндекс</td>
      <td>
        <a href="{{ Acp::show($model->yandexUser) }}">
          {{ $model->yandexUser->account }}
        </a>
      </td>
    </tr>
  @endif
  @if ($model->ipv4)
    <tr>
      <td class="text-right font-bold">IPv4</td>
      <td>{{ $model->ipv4 }}</td>
    </tr>
  @endif
  @if ($model->ipv6)
    <tr>
      <td class="text-right font-bold">IPv6</td>
      <td>{{ $model->ipv6 }}</td>
    </tr>
  @endif
  <tr>
    <td class="text-right font-bold">MX</td>
    <td>{{ $model->mx }}</td>
  </tr>
  <tr>
    <td class="text-right font-bold">NS</td>
    <td>{{ $model->ns }}</td>
  </tr>
</table>
@parent
@endsection
