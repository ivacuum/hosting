@extends('acp.list', [
  'searchForm' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Скрытые' => App\Domain\MagnetStatus::Hidden->value,
    'Удаленные' => App\Domain\MagnetStatus::Deleted->value,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <th>@lang('model.author')</th>
    <x-th-numeric-sortable key="views">@svg(eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="comments_count">@svg(comment-o)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="clicks">@svg(magnet)</x-th-numeric-sortable>
    <th></th>
    <th>@lang('model.title')</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
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
        @if ($model->status === App\Domain\MagnetStatus::Hidden)
          <span class="tooltipped tooltipped-n" aria-label="Раздача скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Domain\MagnetStatus::Deleted)
          <span class="tooltipped tooltipped-n" aria-label="Раздача удалена">
            @svg (trash-o)
          </span>
        @endif
      </td>
      <td><a href="{{ Acp::show($model) }}">{{ $model->shortTitle() }}</a></td>
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
