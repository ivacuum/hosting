@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'title') }}</th>
    <th></th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th>Дата</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status === App\News::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Новость скрыта">
            @svg (eye-slash)
          </span>
        @endif
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
      <td>{{ ViewHelper::dateShort($model->created_at) }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
