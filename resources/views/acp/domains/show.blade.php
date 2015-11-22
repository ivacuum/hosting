@extends('acp.domains.base', [
  'meta_title' => $domain->domain,
])

@section('content')
  @if ($domain->text)
    <blockquote>{!! nl2br($domain->text) !!}</blockquote>
  @endif

  @if ($domain->isExpired())
    <div class="alert alert-danger">
      Подошел срок оплаты домена — {{ $domain->paid_till->addMonth()->formatLocalized('%e %B') }} ({{ $domain->paid_till->addMonth()->diffForHumans() }}) он совсем пропадет
    </div>
  @endif

  @if ($domain->isExpiringSoon())
    <div class="alert alert-warning">
      {{ $domain->paid_till->formatLocalized('%e %B') }} ({{ $domain->paid_till->diffForHumans() }}) подходит срок оплаты домена
    </div>
  @endif

  <table class="table-stats">
    @if ($domain->alias)
      <tr>
        <td><strong>Алиас</strong></td>
        <td>
          <a class="link" href="{{ action("$self@show", $domain->alias) }}">{{ $domain->alias->domain }}</a>
        </td>
      </tr>
    @endif
    @if (sizeof($domain->aliases))
      <tr>
        <td><strong>Алиасы</strong></td>
        <td>
          @foreach ($domain->aliases as $alias)
            <a class="link" href="{{ action("$self@show", $alias) }}">{{ $alias->domain }}</a>
          @endforeach
        </td>
      </tr>
    @endif
    <tr>
      <td><strong>Клиент</strong></td>
      <td>
        <a class="link" href="{{ action('Acp\Clients@show', $domain->client) }}">
          {{ $domain->client->name }}
        </a>
      </td>
    </tr>
    @if ($domain->yandex_user_id)
      <tr>
        <td><strong>Яндекс</strong></td>
        <td>
          <a class="link" href="{{ action('Acp\Yandex\Users@show', $domain->yandexUser->id) }}">
            {{ $domain->yandexUser->account }}
          </a>
        </td>
      </tr>
    @endif
    @if ($domain->ipv4)
      <tr>
        <td><strong>IPv4</strong></td>
        <td>{{ $domain->ipv4 }}</td>
      </tr>
    @endif
    @if ($domain->ipv6)
      <tr>
        <td><strong>IPv6</strong></td>
        <td>{{ $domain->ipv6 }}</td>
      </tr>
    @endif
    <tr>
      <td><strong>MX</strong></td>
      <td>{{ $domain->mx }}</td>
    </tr>
    <tr>
      <td><strong>NS</strong></td>
      <td>{{ $domain->ns }}</td>
    </tr>
  </table>
@endsection
