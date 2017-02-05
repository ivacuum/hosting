@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <table class="table-stats">
    <thead>
      <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>@svg (magnet)</th>
        <th>Название</th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $model->id }}</td>
        <td>
          <a class="link" href="{{ action('Acp\Users@show', $model->user_id) }}">
            {{ $model->user->displayName() }}
          </a>
        </td>
        <td>
          @if ($model->clicks > 0)
            {{ ViewHelper::number($model->clicks) }}</td>
          @endif
        <td>
          <a class="link" href="{{ action("$self@show", $model) }}">
            <torrent-title title="{{ $model->title }}"></torrent-title>
          </a>
          <a href="{{ $model->externalLink() }}">
            @svg (external-link)
          </a>
        </td>
      </tr>
    @endforeach
  </table>

  <div class="pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
