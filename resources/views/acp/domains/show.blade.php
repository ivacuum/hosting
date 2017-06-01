@extends('acp.show', [
  'meta_title' => $model->domain,
])

@section('content')
@if (!$model->isExpired() && ($model->cms_url || ($model->alias_id && $model->alias->cms_url)))
  <div class="mb-3">
    @include("$tpl.cms_login", ['cms_button_class' => 'btn btn-default'])
  </div>
@endif

@if ($model->text)
  <blockquote>{!! nl2br($model->text) !!}</blockquote>
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
      <td><strong>Алиас</strong></td>
      <td>
        <a href="{{ path("$self@show", $model->alias) }}">{{ $model->alias->domain }}</a>
      </td>
    </tr>
  @endif
  @if (sizeof($model->aliases))
    <tr>
      <td><strong>Алиасы</strong></td>
      <td>
        @foreach ($model->aliases as $alias)
          <a href="{{ path("$self@show", $alias) }}">{{ $alias->domain }}</a>
        @endforeach
      </td>
    </tr>
  @endif
  <tr>
    <td><strong>Клиент</strong></td>
    <td>
      <a href="{{ path('Acp\Clients@show', $model->client) }}">
        {{ $model->client->name }}
      </a>
    </td>
  </tr>
  @if ($model->yandex_user_id)
    <tr>
      <td><strong>Яндекс</strong></td>
      <td>
        <a href="{{ path('Acp\YandexUsers@show', $model->yandexUser->id) }}">
          {{ $model->yandexUser->account }}
        </a>
      </td>
    </tr>
  @endif
  @if ($model->ipv4)
    <tr>
      <td><strong>IPv4</strong></td>
      <td>{{ $model->ipv4 }}</td>
    </tr>
  @endif
  @if ($model->ipv6)
    <tr>
      <td><strong>IPv6</strong></td>
      <td>{{ $model->ipv6 }}</td>
    </tr>
  @endif
  <tr>
    <td><strong>MX</strong></td>
    <td>{{ $model->mx }}</td>
  </tr>
  <tr>
    <td><strong>NS</strong></td>
    <td>{{ $model->ns }}</td>
  </tr>
</table>
@parent
@endsection
