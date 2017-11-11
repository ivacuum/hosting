@extends('acp.dev.base')

@section('content')
<h3 class="mt-0">Логи</h3>
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
        <span title="{{ $line->time }}">{{ $loop->iteration }}</span>
      </td>
      <td>
        @if ($line->request_method !== 'GET')
          <code>{{ $line->request_method }}</code>
        @endif
        {{ rawurldecode($line->request_uri) }}
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
      <td>{{ str_limit(str_replace(['http://www.', 'https://www.', 'http://', 'https://'], '', $line->referer), 35) }}</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="6" class="text-muted">
        <a href="https://ipinfo.io/{{ $line->ip }}">{{ $line->ip }}</a>
        {{ $line->country }}
        &middot;
        {{ Ivacuum\Generic\Utilities\UserAgent::tidy($line->user_agent) }}
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
