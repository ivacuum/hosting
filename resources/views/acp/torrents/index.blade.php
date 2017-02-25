@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell text-right">ID</div>
      <div class="flex-cell">Автор</div>
      <div class="flex-cell text-right">@svg (eye)</div>
      <div class="flex-cell text-right">@svg (comment-o)</div>
      <div class="flex-cell text-right">@svg (magnet)</div>
      <div class="flex-cell">Название</div>
      <div class="flex-cell"></div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell text-right">{{ $model->id }}</div>
          <div class="flex-cell">
            <a class="link" href="{{ action('Acp\Users@show', $model->user_id) }}">
              {{ $model->user->displayName() }}
            </a>
          </div>
          <div class="flex-cell text-right">
            @if ($model->views > 0)
              {{ ViewHelper::number($model->views) }}
            @endif
          </div>
          <div class="flex-cell text-right">
            @if ($model->comments_count > 0)
              {{ ViewHelper::number($model->comments_count) }}
            @endif
          </div>
          <div class="flex-cell text-right">
            @if ($model->clicks > 0)
              {{ ViewHelper::number($model->clicks) }}
            @endif
          </div>
          <div class="flex-cell">
            <a class="link" href="{{ action("$self@show", $model) }}">
              <torrent-title title="{{ $model->title }}" hide_brackets="1"></torrent-title>
            </a>
          </div>
          <div class="flex-cell">
            <a href="{{ $model->externalLink() }}">
              @svg (external-link)
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @include('tpl.paginator', ['class' => 'mt-3 text-center', 'paginator' => $models])
@endif
@endsection
