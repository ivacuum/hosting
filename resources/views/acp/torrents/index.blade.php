@extends('acp.list', [
  'searchForm' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Скрытые' => App\Domain\TorrentStatus::Hidden->value,
    'Удаленные' => App\Domain\TorrentStatus::Deleted->value,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>@lang('model.author')</th>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'comments_count', 'svg' => 'comment-o'])
    </th>
    <th class="md:text-right whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'clicks', 'svg' => 'magnet'])
    </th>
    <th></th>
    <th>@lang('model.title')</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ path([App\Http\Controllers\Acp\Users::class, 'show'], $model->user_id) }}">
          {{ $model->user->displayName() }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ path([App\Http\Controllers\Acp\Comments::class, 'index'], [$model->getForeignKey() => $model]) }}">
          {{ ViewHelper::number($model->comments_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->clicks) ?: '' }}
      </td>
      <td>
        @if ($model->status === App\Domain\TorrentStatus::Hidden)
          <span class="tooltipped tooltipped-n" aria-label="Раздача скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Domain\TorrentStatus::Deleted)
          <span class="tooltipped tooltipped-n" aria-label="Раздача удалена">
            @svg (trash-o)
          </span>
        @endif
      </td>
      <td><a href="{{ path([$controller, 'show'], $model) }}">{{ $model->shortTitle() }}</a></td>
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
