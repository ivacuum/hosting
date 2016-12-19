@extends('torrents.base')

@section('content')
<p class="text-center">
  {{ $torrent->localizedSize() }}
  &middot;
  <span class="text-success">{{ $torrent->seeders }} сидов</span>
  &middot;
  <a class="link" href="https://rutracker.org/forum/viewtopic.php?t={{ $torrent->rto_id }}">первоисточник</a>
</p>
<div class="rutracker-post">
  {!! $torrent->text !!}
</div>
@endsection
