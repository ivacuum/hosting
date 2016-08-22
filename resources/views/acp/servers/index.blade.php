@extends('acp.base')

@section('content')
<h3>
  Серверы
  <small>{{ sizeof($servers) }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($servers))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <th>#</th>
        <th>Сервер</th>
        <th>Хост</th>
        <th></th>
      </tr>
    </thead>
    @foreach ($servers as $i => $server)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $server) }}">
        <td>{{ $i + 1 }}</td>
        <td>
          <a href="{{ action("$self@show", $server) }}" class="link">
            {{ $server->title }}
          </a>
        </td>
        <td>{{ $server->host }}</td>
        <td>
          @if ($server->ftp_user and $server->ftp_pass)
            <a class="btn btn-default btn-xs" href="{{ action("$self\Ftp@index", [$server]) }}">
              FTP
            </button>
          @endif
        </td>
      </tr>
    @endforeach
  </table>
@endif
@endsection
