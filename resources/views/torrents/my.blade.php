@extends('torrents.base')

@section('content')
@if (sizeof($torrents))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th>{{ ViewHelper::modelFieldTrans('torrent', 'title') }}</th>
        <th class="text-muted md:text-right" title="{{ ViewHelper::modelFieldTrans('torrent', 'views') }}">@svg (eye)</th>
        <th class="md:text-right" title="{{ ViewHelper::modelFieldTrans('torrent', 'comments') }}">@svg (comment-o)</th>
        <th class="md:text-right" title="{{ ViewHelper::modelFieldTrans('torrent', 'clicks') }}">@svg (magnet)</th>
        <th>{{ ViewHelper::modelFieldTrans('torrent', 'size') }}</th>
        <th>{{ ViewHelper::modelFieldTrans('torrent', 'updated_at') }}</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($torrents as $torrent)
        <tr>
          <td><a class="visited" href="{{ $torrent->www() }}">{{ $torrent->shortTitle() }}</a></td>
          <td class="text-muted md:text-right whitespace-no-wrap">{{ $torrent->views ? ViewHelper::number($torrent->views) : '' }}</td>
          <td class="md:text-right whitespace-no-wrap">{{ $torrent->comments_count ? ViewHelper::number($torrent->comments_count) : '' }}</td>
          <td class="md:text-right whitespace-no-wrap">{{ $torrent->clicks ? ViewHelper::number($torrent->clicks) : '' }}</td>
          <td class="text-muted whitespace-no-wrap">{{ ViewHelper::size($torrent->size) }}</td>
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
  <p><a class="btn btn-default" href="{{ path([App\Http\Controllers\Torrents::class, 'create']) }}">{{ trans('torrents.create') }}</a></p>
@endif
@endsection
