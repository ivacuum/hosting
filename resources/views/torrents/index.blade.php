@extends('torrents.base')

@section('content')
@if (sizeof($torrents))
  <table class="table-stats m-b-1">
    <thead>
      <tr>
        <td>Дата</td>
        <td></td>
        <td>Раздача</td>
        <td>Размер</td>
        <td>Сиды</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($torrents as $torrent)
        <tr>
          <td>{{ $torrent->shortDate() }}</td>
          <td>
            <a class="link" href="{{ $torrent->magnet() }}">
              @svg (magnet)
            </a>
          </td>
          <td>
            <a class="link" href="{{ action("{$self}@torrent", $torrent) }}">
              {{ $torrent->title }}
            </a>
          </td>
          <td>{{ ViewHelper::size($torrent->size) }}</td>
          <td class="text-success">{{ $torrent->seeders }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="m-y-1 text-center">
    @include('tpl.paginator', ['paginator' => $torrents])
  </div>
@else
  <p>Подходящих раздач не найдено.</p>
@endif
@endsection
