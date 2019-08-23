@extends('acp.show')

@section('content')
@if (optional($related_torrents = $model->relatedTorrents())->count())
  <h4>
    {{ trans('torrents.related') }}
    <span class="tw-text-base text-muted">{{ $related_torrents->count() }}</span>
  </h4>
  <ol>
    @foreach ($related_torrents as $row)
      <li><a href="{{ path('Acp\Torrents@show', $row) }}">{{ $row->shortTitle() }}</a></li>
    @endforeach
  </ol>
@endif
@parent
@endsection
