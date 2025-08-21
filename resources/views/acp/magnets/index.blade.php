@extends('acp.list', [
  'searchForm' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'status',
  'values' => [
    'Все' => null,
    '---' => null,
    'Скрытые' => App\Domain\Magnet\MagnetStatus::Hidden->value,
    'Удаленные' => App\Domain\Magnet\MagnetStatus::Deleted->value,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <x-th-numeric-sortable key="id"/>
    <x-th key="author"></x-th>
    <x-th-numeric-sortable key="views">@svg(eye)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="comments_count">@svg(comment-o)</x-th-numeric-sortable>
    <x-th-numeric-sortable key="clicks">@svg(magnet)</x-th-numeric-sortable>
    <th></th>
    <x-th key="title"></x-th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="md:text-right">{{ $model->id }}</td>
      <td>
        <a href="{{ Acp::show($model->user) }}">
          {{ $model->user->displayName() }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Comment, $model) }}">
          {{ ViewHelper::number($model->comments_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->clicks) ?: '' }}
      </td>
      <td>
        @if ($model->status === App\Domain\Magnet\MagnetStatus::Hidden)
          <span class="tooltipped tooltipped-n" aria-label="Раздача скрыта">
            @svg (eye-slash)
          </span>
        @elseif ($model->status === App\Domain\Magnet\MagnetStatus::Deleted)
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
