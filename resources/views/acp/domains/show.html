@extends('acp.domains.base', [
  'meta_title' => $domain->domain,
])

@section('content')
<div id="ajax_container" {{--class="js-deferred-load" data-deferred-url="{{ action("$self@$tab", $domain) }}"--}}>
  @if ($domain->text)
    <blockquote>{!! nl2br($domain->text) !!}</blockquote>
  @endif

  @if ($domain->isExpired())
    <div class="alert alert-danger">
      Подошел срок оплаты домена — {{ $domain->paid_till->addMonth()->formatLocalized('%d %B') }} ({{ $domain->paid_till->addMonth()->diffForHumans() }}) он совсем пропадет
    </div>
  @endif

  @if ($domain->isExpiringSoon())
    <div class="alert alert-warning">
      {{ $domain->paid_till->formatLocalized('%d %B') }} ({{ $domain->paid_till->diffForHumans() }}) подходит срок оплаты домена
    </div>
  @endif
  
  <p>
    <strong>Клиент</strong>:
    <a class="link" href="{{ action('Acp\Clients@show', $domain->client) }}">
      {{ $domain->client->name }}
    </a>
  </p>
  
  <p>
    <strong>Яндекс</strong>:
    <a class="link" href="{{ action('Acp\Yandex\Users@show', $domain->yandexUser->id) }}">
      {{ $domain->yandexUser->account }}
    </a>
  </p>
  
  <p>
    <strong>IPv4</strong>:
    {{ $domain->ipv4 }}
  </p>
  
  @if ($domain->ipv6)
    <p>
      <strong>IPv6</strong>:
      {{ $domain->ipv6 }}
    </p>
  @endif
  
  <p>
    <strong>MX</strong>:
    {{ $domain->mx }}
  </p>
  
  <p>
    <strong>NS</strong>:
    {{ $domain->ns }}
  </p>
</div>
@endsection
