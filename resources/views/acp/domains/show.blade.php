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
  <div class="alert alert-danger">
    Подошел срок оплаты домена — {{ $model->paid_till->addMonth()->formatLocalized('%e %B') }} ({{ $model->paid_till->addMonth()->diffForHumans() }}) он совсем пропадет
  </div>
@endif

@if ($model->isExpiringSoon())
  <div class="alert alert-warning">
    {{ $model->paid_till->formatLocalized('%e %B') }} ({{ $model->paid_till->diffForHumans() }}) подходит срок оплаты домена
  </div>
@endif

<table class="table-stats">
  @if ($model->alias)
    <tr>
      <td class="text-right font-bold">Алиас</td>
      <td>
        <a href="{{ path([$controller, 'show'], $model->alias) }}">{{ $model->alias->domain }}</a>
      </td>
    </tr>
  @endif
  @if (sizeof($model->aliases))
    <tr>
      <td class="text-right font-bold">Алиасы</td>
      <td>
        @foreach ($model->aliases as $alias)
          <a href="{{ path([$controller, 'show'], $alias) }}">{{ $alias->domain }}</a>
        @endforeach
      </td>
    </tr>
  @endif
  <tr>
    <td class="text-right font-bold">Клиент</td>
    <td>
      <a href="{{ path([App\Http\Controllers\Acp\Clients::class, 'show'], $model->client) }}">
        {{ $model->client->name }}
      </a>
    </td>
  </tr>
  @if ($model->yandex_user_id)
    <tr>
      <td class="text-right font-bold">Яндекс</td>
      <td>
        <a href="{{ path([App\Http\Controllers\Acp\YandexUsers::class, 'show'], $model->yandexUser->id) }}">
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
