@extends('torrents.base')

@section('content')
@if (sizeof($torrents))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th>{{ ViewHelper::modelFieldTrans('torrent', 'title') }}</th>
        <th class="text-muted text-md-right" title="{{ ViewHelper::modelFieldTrans('torrent', 'views') }}">@svg (eye)</th>
        <th class="text-md-right" title="{{ ViewHelper::modelFieldTrans('torrent', 'comments') }}">@svg (comment-o)</th>
        <th class="text-md-right" title="{{ ViewHelper::modelFieldTrans('torrent', 'clicks') }}">@svg (magnet)</th>
        <th>{{ ViewHelper::modelFieldTrans('torrent', 'size') }}</th>
        <th>{{ ViewHelper::modelFieldTrans('torrent', 'updated_at') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($torrents as $torrent)
        <tr>
          <td><a class="visited" href="{{ $torrent->www() }}">{{ $torrent->shortTitle() }}</a></td>
          <td class="text-muted text-md-right">{{ $torrent->views ? ViewHelper::number($torrent->views) : '' }}</td>
          <td class="text-md-right">{{ $torrent->comments_count ? ViewHelper::number($torrent->comments_count) : '' }}</td>
          <td class="text-md-right">{{ $torrent->clicks ? ViewHelper::number($torrent->clicks) : '' }}</td>
          <td class="text-muted">{{ ViewHelper::size($torrent->size) }}</td>
          <td>{{ ViewHelper::dateShort($torrent->registered_at) }}</td>
          <td>
            <a class="visited" href="{{ $torrent->externalLink() }}">
              @svg (external-link)
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @include('tpl.paginator', ['paginator' => $torrents])
@else
  @ru
    <p>Вы еще не добавили ни одной раздачи.</p>
  @en
    <p>You haven't released anything yet.</p>
  @endru
  <p><a class="btn btn-default" href="{{ path('Torrents@create') }}">{{ trans('torrents.create') }}</a></p>
@endif
@endsection
