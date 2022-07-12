@extends('acp.dev.base')

@section('content')
<div class="flex flex-wrap gap-4 items-center mb-2">
  <h3 class="mb-1">Логи</h3>
  <form>
    <input class="form-input" type="text" name="q" enterkeyhint="search" placeholder="Поиск..." value="{{ $q ?? '' }}">
  </form>
</div>
<table class="text-xs table-stats table-adaptive">
  <thead>
  <tr>
    <th>#</th>
    <th>Запрос</th>
    <th>Статус</th>
    <th></th>
    <th></th>
    <th>Источник</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($lines->reverse() as $line)
    <tr>
      <td>
        <a href="{{ UrlHelper::filter(['q' => "connection={$line->connection}"]) }}" title="{{ $line->time }}">{{ $line->connection }}</a>
      </td>
      <td>
        @if ($line->request_method !== 'GET')
          <code>{{ $line->request_method }}</code>
        @endif
        <span title="{{ rawurldecode($line->request_uri) }}">{{ Str::limit(rawurldecode($line->request_uri), 50) }}</span>
      </td>
      <td>
        @if ($line->status != 200)
          {{ $line->status }}
        @endif
      </td>
      <td>
        @if ($line->request_time != 0)
          @if ($line->request_time > 2)
            <span class="text-red-600">{{ $line->request_time }}</span>
          @else
            {{ $line->request_time }}
          @endif
        @endif
      </td>
      <td>{{ ViewHelper::size($line->body_bytes_sent) ?: '' }}</td>
      <td>
        <span title="{{ $line->referer }}">
          {{ Str::limit(str_replace(['http://www.', 'https://www.', 'http://', 'https://'], '', $line->referer), 35) }}
        </span>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="5" class="text-muted">
        <a href="{{ UrlHelper::filter(['q' => "ip={$line->ip}"]) }}">{{ $line->ip }}</a>
        <a href="https://ipinfo.io/{{ $line->ip }}">{{ $line->country }}</a>
        &middot;
        <span title="{{ $line->user_agent }}">{{ Ivacuum\Generic\Utilities\UserAgent::tidy($line->user_agent) }}</span>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
