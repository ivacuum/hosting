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
        <th>Название</th>
        <th></th>
        <th class="text-right">@svg (eye)</th>
        <th class="text-right">@svg (comment-o)</th>
        <th>Дата</th>
      </tr>
    </thead>
    @foreach ($models as $model)
      <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", $model) }}">
        <td>{{ $model->id }}</td>
        <td>
          <a class="link" href="{{ action("$self@show", $model) }}">
            {{ $model->title }}
          </a>
        </td>
        <td>
          @if ($model->status === App\News::STATUS_HIDDEN)
            <span class="tooltipped tooltipped-s" aria-label="Новость скрыта">
              @svg (eye-slash)
            </span>
          @endif
        </td>
        <td class="text-right">{{ ViewHelper::number($model->views) }}</td>
        <td class="text-right">
          @if ($model->comments_count > 0)
            {{ ViewHelper::number($model->comments_count) }}
          @endif
        </td>
        <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
      </tr>
    @endforeach
  </table>

  <div class="mt-3 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
