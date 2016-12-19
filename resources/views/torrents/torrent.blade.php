@extends('torrents.base')

@section('content')
<div class="panel panel-default text-center center-block torrent-stats-container">
  <div class="panel-heading">
    Статистика раздачи
    <a href="https://rutracker.org/forum/viewtopic.php?t={{ $torrent->rto_id }}">
      @svg (external-link)
    </a>
  </div>
  <div class="panel-body">
    Размер: <strong>{{ $torrent->localizedSize() }}</strong>
    <span class="torrent-stats-separator">&middot;</span>
    Активна: <strong>{{ $torrent->registered_at->diffForHumans(null, true) }}</strong>
    <span class="torrent-stats-separator">&middot;</span>
    <span class="text-success">{{ $torrent->seeders }} {{ trans_choice('plural.seeders', $torrent->seeders) }}</span>
  </div>
  <div class="panel-footer"><a class="btn btn-success" href="{{ $torrent->magnet() }}">Скачать</a></div>
</div>
<rutracker-post>{!! $torrent->text !!}</rutracker-post>
@endsection
