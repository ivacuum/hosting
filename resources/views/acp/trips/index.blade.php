@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Опубликованные' => App\Trip::STATUS_PUBLISHED,
    'Пишутся' => App\Trip::STATUS_INACTIVE,
    'Скрытые' => App\Trip::STATUS_HIDDEN,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-md-right">#</th>
    <th>Название</th>
    <th></th>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'date_start'])
    </th>
    <th>URL</th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th>@svg (paperclip)</th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'photos_count', 'svg' => 'picture-o'])
    </th>
    <th class="text-md-right"></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-md-right">{{ ViewHelper::paginatorIteration($models, $loop) }}</td>
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td>
        @if ($model->status === App\Trip::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Заметка скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Trip::STATUS_INACTIVE)
          <span class="tooltipped tooltipped-n" aria-label="Заметка пишется">
            @svg (pencil)
          </span>
        @endif
      </td>
      <td>{{ $model->localizedDate() }}</td>
      <td>
        <a href="{{ $model->www() }}">
          {{ $model->slug }}
        </a>
      </td>
      <td class="text-md-right">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td class="text-md-right">
        @if ($model->comments_count > 0)
          {{ ViewHelper::number($model->comments_count) }}
        @endif
      </td>
      <td>
        @if ($model->meta_image)
          <a href="{{ $model->metaImage() }}">
            <span class="tooltipped tooltipped-n" aria-label="Обложка">
              @svg (paperclip)
            </span>
          </a>
        @endif
      </td>
      <td class="text-md-right">
        @if ($model->photos_count > 0)
          <a href="{{ path('Acp\Photos@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->photos_count) }}
          </a>
        @endif
      </td>
      <td class="text-md-right">
        @if ($model->user_id === 1)
          <a href="{{ path('Acp\Dev\Templates@show', str_replace('.', '_', $model->slug)) }}">
            @svg (file-text-o)
          </a>
        @else
          <a href="{{ path('Acp\Users@show', $model->user_id) }}">#{{ $model->user_id }}</a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
