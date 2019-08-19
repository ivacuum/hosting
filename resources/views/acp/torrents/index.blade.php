@extends('acp.list', [
  'search_form' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Скрытые' => App\Torrent::STATUS_HIDDEN,
    'Удаленные' => App\Torrent::STATUS_DELETED,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:tw-text-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>{{ trans('model.author') }}</th>
    <th class="md:tw-text-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="md:tw-text-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th class="md:tw-text-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'clicks', 'svg' => 'magnet'])
    </th>
    <th></th>
    <th>{{ trans('model.title') }}</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="md:tw-text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path('Acp\Users@show', $model->user_id) }}">
          {{ $model->user->displayName() }}
        </a>
      </td>
      <td class="md:tw-text-right tw-whitespace-no-wrap">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td class="md:tw-text-right tw-whitespace-no-wrap">
        @if ($model->comments_count > 0)
          <a href="{{ path('Acp\Comments@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->comments_count) }}
          </a>
        @endif
      </td>
      <td class="md:tw-text-right tw-whitespace-no-wrap">
        @if ($model->clicks > 0)
          {{ ViewHelper::number($model->clicks) }}
        @endif
      </td>
      <td>
        @if ($model->status === App\Torrent::STATUS_HIDDEN)
          <span class="tooltipped tooltipped-n" aria-label="Раздача скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Torrent::STATUS_DELETED)
          <span class="tooltipped tooltipped-n" aria-label="Раздача удалена">
            @svg (trash-o)
          </span>
        @endif
      </td>
      <td><a href="{{ path("$self@show", $model) }}">{{ $model->shortTitle() }}</a></td>
      <td>
        <a href="{{ $model->externalLink() }}">
          @svg (external-link)
        </a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
