@extends('acp.dev.base')

@section('content')
<div class="d-flex flex-wrap align-items-center mb-2">
  <h3 class="mt-0 mb-1">Логи</h3>
  <form class="heading-menu-search-form">
    <input name="q" class="form-control" placeholder="Поиск..." value="{{ $q ?? '' }}">
  </form>
</div>
<table class="f13 table-stats table-adaptive">
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
        <span title="{{ $line->time }}">{{ $line->connection }}</span>
      </td>
      <td>
        @if ($line->request_method !== 'GET')
          <code>{{ $line->request_method }}</code>
        @endif
        <span title="{{ rawurldecode($line->request_uri) }}">{{ str_limit(rawurldecode($line->request_uri), 50) }}</span>
      </td>
      <td>
        @if ($line->status != 200)
          {{ $line->status }}
        @endif
      </td>
      <td>
        @if ($line->request_time != 0)
          @if ($line->request_time > 2)
            <span class="text-danger">{{ $line->request_time }}</span>
          @else
            {{ $line->request_time }}
          @endif
        @endif
      </td>
      <td>
        @if ($line->body_bytes_sent > 0)
          {{ ViewHelper::size($line->body_bytes_sent) }}
        @endif
      </td>
      <td>
        <span title="{{ $line->referer }}">
          {{ str_limit(str_replace(['http://www.', 'https://www.', 'http://', 'https://'], '', $line->referer), 35) }}
        </span>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan="5" class="text-muted">
        <a href="https://ipinfo.io/{{ $line->ip }}">{{ $line->ip }}</a>
        {{ $line->country }}
        &middot;
        <span title="{{ $line->user_agent }}">{{ Ivacuum\Generic\Utilities\UserAgent::tidy($line->user_agent) }}</span>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
