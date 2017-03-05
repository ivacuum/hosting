@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
</h3>
@if (sizeof($models))
  <table class="table-stats table-adaptive">
    <thead>
      <tr>
        <th class="text-right">ID</th>
        <th>Автор</th>
        <th class="text-right">@svg (eye)</th>
        <th class="text-right">@svg (comment-o)</th>
        <th class="text-right">@svg (magnet)</th>
        <th>Название</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <td class="text-right">{{ $model->id }}</td>
          <td>
            <a class="link" href="{{ action('Acp\Users@show', $model->user_id) }}">
              {{ $model->user->displayName() }}
            </a>
          </td>
          <td class="text-right">
            @if ($model->views > 0)
              {{ ViewHelper::number($model->views) }}
            @endif
          </td>
          <td class="text-right">
            @if ($model->comments_count > 0)
              {{ ViewHelper::number($model->comments_count) }}
            @endif
          </td>
          <td class="text-right">
            @if ($model->clicks > 0)
              {{ ViewHelper::number($model->clicks) }}
            @endif
          </td>
          <td>
            <a class="link" href="{{ action("$self@show", $model) }}">
              <torrent-title title="{{ $model->title }}" hide_brackets="1"></torrent-title>
            </a>
          </td>
          <td>
            <a href="{{ $model->externalLink() }}">
              @svg (external-link)
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @include('tpl.paginator', ['paginator' => $models])
@endif
@endsection
