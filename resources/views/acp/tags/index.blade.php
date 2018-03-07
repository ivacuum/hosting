@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'title', 'order' => 'asc'])
    </th>
    <th class="text-md-right">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th class="text-md-right">
      @include('acp.tpl.sortable-header', ['key' => 'photos_count', 'svg' => 'picture-o'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>
        <a href="{{ path("$self@show", $model) }}">
          {{ $model->title }}
        </a>
      </td>
      <td class="text-md-right text-nowrap">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td class="text-md-right text-nowrap">
        @if ($model->photos_count > 0)
          <a href="{{ path('Acp\Photos@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->photos_count) }}
          </a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
