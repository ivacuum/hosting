@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ $models->total() }}</small>
  @include('acp.tpl.create')
</h3>
@if (sizeof($models))
  <div class="flex-table flex-table-bordered">
    <div class="flex-row flex-row-header">
      <div class="flex-cell text-right">ID</div>
      <div class="flex-cell">Название</div>
      <div class="flex-cell"></div>
      <div class="flex-cell text-right">@svg (eye)</div>
      <div class="flex-cell text-right">@svg (comment-o)</div>
      <div class="flex-cell">Дата</div>
    </div>
    <div class="flex-row-group flex-row-striped">
      @foreach ($models as $model)
        <div class="flex-row js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
          <div class="flex-cell text-right">{{ $model->id }}</div>
          <div class="flex-cell">
            <a class="link" href="{{ action("$self@show", $model) }}">
              {{ $model->title }}
            </a>
          </div>
          <div class="flex-cell">
            @if ($model->status === App\News::STATUS_HIDDEN)
              <span class="tooltipped tooltipped-n" aria-label="Новость скрыта">
              @svg (eye-slash)
            </span>
            @endif
          </div>
          <div class="flex-cell text-right">{{ ViewHelper::number($model->views) }}</div>
          <div class="flex-cell text-right">
            @if ($model->comments_count > 0)
              {{ ViewHelper::number($model->comments_count) }}
            @endif
          </div>
          <div class="flex-cell">{{ ViewHelper::dateShort($model->created_at) }}</div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="text-center mt-3">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
