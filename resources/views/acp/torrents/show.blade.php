@extends('acp.show')

@section('content')
@if (optional($relatedTorrents = $model->relatedTorrents())->count())
  <h4>
    {{ __('Связанные раздачи') }}
    <span class="text-base text-muted">{{ $relatedTorrents->count() }}</span>
  </h4>
  <ol>
    @foreach ($relatedTorrents as $row)
      <li><a href="{{ path([App\Http\Controllers\Acp\Torrents::class, 'show'], $row) }}">{{ $row->shortTitle() }}</a></li>
    @endforeach
  </ol>
@endif
@parent
@endsection
